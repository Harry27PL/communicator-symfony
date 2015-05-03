'use strict';

define(['Chat/Chat',  './ChatPhone', './ChatPhone.SendOffer', './ChatPhone.Answer'],
function (Chat,       ChatPhone,     ChatPhoneSendOffer,      ChatPhoneAnswer) {

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
        if (typeof(offers[Chat.getInterlocutorId()]) == 'undefined')
            return;

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

    function answer()
    {
        ChatPhone.stopRing();

        ChatPhoneAnswer.answer(Chat.getInterlocutorId(), function(){
            startChat();
        });
    }

    function startChat()
    {
        if (callVideo) {
            $('video').show();
            $('.dialer-avatar img').hide();
        }

        $('.dialer-buttons').addClass('hidden');
        $('.dialer-buttons-calling').removeClass('hidden');
    }

    var ChatPhoneDialer = {

        handleClickOpen: toggle,

        handleClickVideoChat: startVideoChat,
        handleClickVoiceChat: startVoiceChat,
        handleClickAnswer:    answer,

        startChat: startChat,

        handleChatChange: handleChatChange,

        setOffer: setOffer

    };

    return ChatPhoneDialer;

});