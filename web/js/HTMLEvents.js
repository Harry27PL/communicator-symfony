'use strict';

define([
    'Control/Call.Button',
    'Layout/Layout.ResetScrollbar',
    'ChatText/ChatText.Input',
    'ChatText/ChatText.Messages',
    'ContactList/ContactList'
],
function (
    CallButton,
    LayoutResetScrollbar,
    ChatTextInput,
    ChatTextMessages,
    ContactList
) {

    $(document).ready(function(){
        LayoutResetScrollbar.handleReady();
        ChatTextInput.handleReady();
        ChatTextMessages.handleReady();
    });

    $(document).on('click', '.call', function(e){
        CallButton.handleClick(e);
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

});