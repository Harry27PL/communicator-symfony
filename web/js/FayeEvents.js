'use strict';

define([
    'ChatPhone/Phone.Answer',
    'ChatPhone/Phone.Complete',
    'ChatPhone/Phone.ICECandidate',
    'ChatText/ChatText.Messages',
    'ContactList/ContactList.Online'
], function(
    PhoneAnswer,
    PhoneComplete,
    PhoneICECandidate,
    ChatTextMessages,
    ContactListOnline
){

    var client, clientAuth;
    client = new Faye.Client('http://'+window.location.hostname+':8000/faye');

    var clientAuth = {
        outgoing: function (message, callback) {
            if (message.channel !== '/meta/subscribe')
                return callback(message);

            if (!message.ext)
                message.ext = {};

            message.ext.authToken = fayeConfig.token;

            callback(message);
        }
    };

    client.addExtension(clientAuth);

    client.subscribe('/'+fayeConfig.id, function(data) {

        switch (data.type) {
            case 'phone.connection.offer':
                PhoneAnswer.answer(data.data.offerSDP, data.data.connectionId, data.data.callerId);
                break;

            case 'phone.connection.answer':
                PhoneComplete.complete(data.data.answerSDP, data.data.connectionId);
                break;

            case 'phone.connection.ICECandidate':
                PhoneICECandidate.addCandidate(data.data.sdpMLineIndex, data.data.sdpMid, data.data.candidate);
                break;

            case 'chatText.message':
                ChatTextMessages.add(data.data.content, data.data.interlocutor);
                break;

            case 'online':
                ContactListOnline.setOnline(data.data);
                break;
        }

    });

});
