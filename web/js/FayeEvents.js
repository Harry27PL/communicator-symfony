'use strict';

define([
    'Phone/Phone.Answer',
    'Phone/Phone.Complete',
    'Phone/Phone.ICECandidate'
], function(
    PhoneAnswer,
    PhoneComplete,
    PhoneICECandidate
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
        }

    });

});
