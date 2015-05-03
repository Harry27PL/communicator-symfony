'use strict';

define([
    'Layout/Layout.ResetScrollbar',
    'ChatText/ChatText.Input',
    'ChatText/ChatText.Messages',
    'ChatPhone/ChatPhone.Dialer',
    'ContactList/ContactList'
],
function (
    LayoutResetScrollbar,
    ChatTextInput,
    ChatTextMessages,
    ChatPhoneDialer,
    ContactList
) {

    $(document).ready(function(){
        LayoutResetScrollbar.handleReady();
        ChatTextInput.handleReady();
        ChatTextMessages.handleReady();
    });

    $(window).on('resize', function(){
        LayoutResetScrollbar.handleResize();
        ChatTextMessages.handleResize();
    });

    $(window).on('scroll', function(){
        LayoutResetScrollbar.handleResize();
        ChatTextMessages.handleResize();
        window.scrollTo(0, 0);
    });

    $(document).on('click', '.layout-sidebar-contactList a', function(e){
        ContactList.handleClick(e);
    });

    $(document).on('keyup', '.chat-text-answer input', function(e){
        ChatTextInput.handleKeyup(e);
    });

    $(document).on('click', '.dialer-button-open', function(e){
        ChatPhoneDialer.handleClickOpen();
    });

    $(document).on('click', '.dialer-button-voicechat', function(e){
        ChatPhoneDialer.handleClickVoiceChat();
    });

    $(document).on('click', '.dialer-button-videochat', function(e){
        ChatPhoneDialer.handleClickVideoChat();
    });

    $(document).on('click', '.dialer-button-answer', function(e){
        ChatPhoneDialer.handleClickAnswer();
    });

});