'use strict';

define(['../App'],
function (App) {

    function focus()
    {
        $('.chat-text-answer textarea').focus();
    }

    var ChatTextInput = {
        handleReady: focus
    };

    return ChatTextInput;

});