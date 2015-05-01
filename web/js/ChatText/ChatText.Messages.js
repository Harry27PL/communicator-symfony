'use strict';

define(['../App'],
function (App) {

    function getEl()
    {
        return $('.chat-text-messages');
    }

    function setHeight()
    {
        var el = getEl();

        var header = $('.chat-header').outerHeight();
        var answer = $('.chat-text-answer').outerHeight();
        var paddings = parseInt(el.css('padding-top')) + parseInt(el.css('padding-bottom'));

        el.height($(window).height() - header - answer - paddings);
    }

    function setScrollbar()
    {
        getEl().perfectScrollbar();
    }

    function updateScrollbar()
    {
        getEl().perfectScrollbar('update');
    }

    function scrollToEnd()
    {
        var el = getEl();

        el.scrollTop( el.prop('scrollHeight'));
    }

    function resetOnReady()
    {
        setHeight();
        setScrollbar();
        scrollToEnd();
    }

    function resetOnChange()
    {
        setHeight();
        updateScrollbar();
        scrollToEnd();
    }

    var ChatTextMessages = {
        handleReady: resetOnReady,
        handleResize: resetOnChange
    };

    return ChatTextMessages;

});