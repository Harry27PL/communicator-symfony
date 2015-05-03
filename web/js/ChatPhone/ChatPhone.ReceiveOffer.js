'use strict';

define(['../Chat/Chat', './ChatPhone', './ChatPhone.Dialer', '../ContactList/ContactList'],
function (Chat,         ChatPhone,     ChatPhoneDialer,      ContactList) {

    function receiveOffer(offerSDP, connectionId, callerId, video)
    {
        offers[callerId] = {
            sdp:          offerSDP,
            video:        video,
            connectionId: connectionId
        };

        ContactList.setCalling(callerId);

        ChatPhone.startRing();

        if (callerId == Chat.getInterlocutorId())
            ChatPhoneDialer.setOffer();
    }

    var ChatPhoneOffer = {

        receiveOffer: receiveOffer

    };

    return ChatPhoneOffer;

});