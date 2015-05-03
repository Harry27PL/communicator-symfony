'use strict';

define(['./ChatPhone', '../ContactList/ContactList'],
function (ChatPhone,   ContactList) {

    function sendReject(interlocutor)
    {
        var offer = offers[interlocutor];

        $.post('/chat/phone/connection/reject/'+offer.connectionId, function(){
            console.log('reject');
        });

        ContactList.clearCalling(interlocutor);
    }

    var ChatPhoneSendReject = {

        sendReject: sendReject

    };

    return ChatPhoneSendReject;

});