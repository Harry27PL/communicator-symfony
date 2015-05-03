'use strict';

define(['../Chat/Chat', './ChatPhone', '../ContactList/ContactList', './ChatPhone.Dialer'],
function (Chat,         ChatPhone,     ContactList,                  ChatPhoneDialer) {

    function receiveReject()
    {
        var interlocutor = Chat.getInterlocutorId();

        delete offers[interlocutor];

        ContactList.clearCalling(interlocutor);

        ChatPhoneDialer.receiveReject();

        ChatPhone.stop();
    }

    var ChatPhoneReceiveReject = {

        receiveReject: receiveReject

    };

    return ChatPhoneReceiveReject;

});