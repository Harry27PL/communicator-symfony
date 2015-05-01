'use strict';

define([
    'App',
    'Layout/Layout.ResetScrollbar',
    'ChatText/ChatText.Input',
    'ChatText/ChatText.Messages'
],
function (
    App,
    LayoutResetScrollbar,
    ChatTextInput,
    ChatTextMessages
) {

    $(App).on('chatChange', function(){
        LayoutResetScrollbar.handleReady();
        ChatTextInput.handleReady();
        ChatTextMessages.handleReady();
    });

});