'use strict';

define(['Chat/Chat',  './ChatPhone', './ChatPhone.SendOffer'],
function (Chat,       ChatPhone,     ChatPhoneSendOffer) {

    function getEl()
    {
        return $('.dialer');
    }

    function toggle()
    {
        if (isCalling)
            return;

        var el = getEl();

        if (el.is('.hidden'))
            open();
        else
            close();
    }

    function open()
    {
        getEl().removeClass('hidden');
    }

    function close()
    {
        getEl().addClass('hidden');
    }

    function setOffer()
    {
        open();
        
        $('.dialer-buttons').addClass('hidden');
        $('.dialer-buttons-incoming').removeClass('hidden');
    }

    function handleChatChange()
    {
        if (offers[Chat.getInterlocutorId()])
            toggle();

        setOffer();
    }

    function startVideoChat()
    {
        ChatPhoneSendOffer.sendOffer(Chat.getInterlocutorId(), true);
    }

    function startVoiceChat()
    {
        ChatPhoneSendOffer.sendOffer(Chat.getInterlocutorId(), false);
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

        startChat: startChat,

        handleChatChange: handleChatChange,

        setOffer: setOffer

    };

    return ChatPhoneDialer;

});