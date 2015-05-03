'use strict';

define([
    'ChatPhone/ChatPhone.ReceiveOffer',
    'ChatPhone/ChatPhone.Complete',
    'ChatPhone/ChatPhone.ICECandidate',
    'ChatText/ChatText.Messages',
    'ContactList/ContactList',
    'ContactList/ContactList.Online'
], function(
    ChatPhoneReceiveOffer,
    ChatPhoneComplete,
    ChatPhoneICECandidate,
    ChatTextMessages,
    ContactList,
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
                ChatPhoneReceiveOffer.receiveOffer(data.data.offerSDP, data.data.connectionId, data.data.callerId, data.data.video);
                break;

            case 'phone.connection.answer':
                ChatPhoneComplete.complete(data.data.answerSDP, data.data.connectionId);
                break;

            case 'phone.connection.ICECandidate':
                ChatPhoneICECandidate.addCandidate(data.data.sdpMLineIndex, data.data.sdpMid, data.data.candidate);
                break;

            case 'chatText.message':
                ChatTextMessages.add(data.data.content, data.data.interlocutor);
                break;

            case 'online':
                ContactListOnline.setOnline(data.data);
                break;

            case 'addUser':
                ContactList.reload();
                break;
        }

    });

});
