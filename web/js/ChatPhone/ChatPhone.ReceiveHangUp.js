'use strict';

define(['../Chat/Chat', './ChatPhone', './ChatPhone.Dialer'],
function (Chat,         ChatPhone,     ChatPhoneDialer) {

    function receiveHangUp()
    {
        var interlocutor = Chat.getInterlocutorId();

        delete offers[interlocutor];

        ChatPhoneDialer.receiveHangUp();

        ChatPhone.stop();
    }

    var ChatPhoneReceiveHangUp = {

        receiveHangUp: receiveHangUp

    };

    return ChatPhoneReceiveHangUp;

});