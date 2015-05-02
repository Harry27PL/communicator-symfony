'use strict';

define(['../App', '../Chat/Chat'],
function (App,     Chat) {

    function getEl()
    {
        return $('.chat-text-answer input');
    }

    function focus()
    {
        getEl().focus();
    }

    function send()
    {
        $.post('/chat/text/send/'+Chat.getInterlocutorId(), {content: getEl().val()});

        getEl().val('');
    }

    var ChatTextInput = {
        handleReady: focus,

        handleKeyup: function(e)
        {
            if (e.keyCode != 13)
                return;
            send();
        }
    };

    return ChatTextInput;

});