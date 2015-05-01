'use strict';

define([], function () {

    function focus()
    {
        $('.chat-text-answer textarea').focus();
    }

    var ChatTextInput = {
        handleReady: focus
    };

    return ChatTextInput;

});