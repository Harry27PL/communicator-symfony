'use strict';

define(['../App'],
function (App) {

    function focus()
    {
        $('.chat-text-answer textarea').focus();
    }

    function send()
    {

    }

    var ChatTextInput = {
        handleReady: focus,

        handleKeyup: function(e) {
            
        }
    };

    return ChatTextInput;

});