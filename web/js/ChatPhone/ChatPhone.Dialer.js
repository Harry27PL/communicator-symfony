'use strict';

define(['Chat/Chat',  './ChatPhone', './ChatPhone.Offer'],
function (Chat,       ChatPhone,     ChatPhoneOffer) {

    function getEl()
    {
        return $('.dialer');
    }

    function toggle()
    {
        if (isCalling)
            return;

        var el = getEl();

        if (el.is('.hidden')) {
            el.removeClass('hidden');
        } else {
            el.addClass('hidden');
        }
    }

    function startVideoChat()
    {
        ChatPhoneOffer.offer(Chat.getInterlocutorId(), true);
    }

    function startVoiceChat()
    {
        ChatPhoneOffer.offer(Chat.getInterlocutorId(), false);
    }

    function startChat()
    {
        if (callVideo) {
            $('video').show();
            $('.dialer-avatar img').hide();
        }

        $('.dialer-button-voicechat').hide();
        $('.dialer-button-videochat').hide();
    }

    var ChatPhoneDialer = {

        handleClickOpen: toggle,

        handleClickVideoChat: startVideoChat,
        handleClickVoiceChat: startVoiceChat,

        startChat: startChat

    };

    return ChatPhoneDialer;

});