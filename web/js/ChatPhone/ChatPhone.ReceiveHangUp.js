'use strict';

define(['../Chat/Chat', './ChatPhone', './ChatPhone.Dialer'],
function (Chat,         ChatPhone,     ChatPhoneDialer) {

    function receiveHangUp()
    {
        var interlocutor = Chat.getInterlocutorId();

        delete offers[interlocutor];

        ChatPhoneDialer.receiveHangUp();

        isCalling = false;
    }

    var ChatPhoneReceiveHangUp = {

        receiveHangUp: receiveHangUp

    };

    return ChatPhoneReceiveHangUp;

});