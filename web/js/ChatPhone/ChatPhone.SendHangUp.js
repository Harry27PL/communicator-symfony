'use strict';

define(['./ChatPhone'],
function (ChatPhone) {

    function sendHangUp(interlocutor)
    {
        var offer = offers[interlocutor];

        $.post('/chat/phone/connection/hangUp/'+offer.connectionId, function(){
            console.log('hang up');
        });

        isCalling = false;
    }

    var ChatPhoneSendHangUp = {

        sendHangUp: sendHangUp

    };

    return ChatPhoneSendHangUp;

});