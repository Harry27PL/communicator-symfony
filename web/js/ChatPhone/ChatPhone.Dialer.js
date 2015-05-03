'use strict';

define([
    'Chat/Chat',
    './ChatPhone',
    './ChatPhone.SendOffer',
    './ChatPhone.SendReject',
    './ChatPhone.Answer'
],
function (
    Chat,
    ChatPhone,
    ChatPhoneSendOffer,
    ChatPhoneSendReject,
    ChatPhoneAnswer
) {

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

    function buttonsOutgoing()
    {
        $('.dialer-buttons').addClass('hidden');
        $('.dialer-buttons-outgoing').removeClass('hidden');
    }

    function buttonsLoading()
    {
        $('.dialer-buttons').addClass('hidden');
    }

    function buttonsIncoming()
    {
        $('.dialer-buttons').addClass('hidden');
        $('.dialer-buttons-incoming').removeClass('hidden');
    }

    function buttonsCalling()
    {
        $('.dialer-buttons').addClass('hidden');
        $('.dialer-buttons-calling').removeClass('hidden');
    }

    function setOffer()
    {
        open();

        buttonsIncoming();
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

        buttonsLoading();
    }

    function startVoiceChat()
    {
        ChatPhoneSendOffer.sendOffer(Chat.getInterlocutorId(), false);

        buttonsLoading();
    }

    function answer()
    {
        ChatPhone.stopRing();

        ChatPhoneAnswer.answer(Chat.getInterlocutorId(), function(){
            startChat();
        });
    }

    function sendReject()
    {
        ChatPhone.stopRing();

        close();

        buttonsOutgoing();

        ChatPhoneSendReject.sendReject(Chat.getInterlocutorId());
    }

    function receiveReject()
    {
        buttonsOutgoing();
    }

    function startChat()
    {
        if (callVideo) {
            $('video').show();
            $('.dialer-avatar img').hide();
        }

        buttonsCalling();
    }

    function endChat()
    {
        //buttonsOutgoing();
    }

    var ChatPhoneDialer = {

        handleClickOpen: toggle,

        handleClickVideoChat: startVideoChat,
        handleClickVoiceChat: startVoiceChat,
        handleClickAnswer:    answer,
        handleClickReject:    sendReject,
        handleClickHangUp:    hangUp,

        startChat: startChat,
        endChat: endChat,

        handleChatChange: handleChatChange,

        setOffer: setOffer,

        receiveReject: receiveReject,
        hangUp: hangUp

    };

    return ChatPhoneDialer;

});