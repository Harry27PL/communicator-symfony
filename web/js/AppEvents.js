'use strict';

define([
    'App',
    'Layout/Layout.ResetScrollbar',
    'ChatText/ChatText.Input',
    'ChatText/ChatText.Messages',
    'ChatPhone/ChatPhone.Dialer'
],
function (
    App,
    LayoutResetScrollbar,
    ChatTextInput,
    ChatTextMessages,
    ChatPhoneDialer
) {

    $(App).on('chatChange', function(){
        LayoutResetScrollbar.handleReady();

        ChatTextInput.handleReady();
        ChatTextMessages.handleReady();

        ChatPhoneDialer.handleChatChange();
    });

});