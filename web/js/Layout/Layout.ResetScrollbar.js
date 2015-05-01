'use strict';

define(['../App'],
function (App) {

    function resetScrollbar(target)
    {
        $('.main-sidebar > div').height($(window).height());

        $('.main-sidebar > div').perfectScrollbar();
    }

    var LayoutResetScrollbars = {

        handleReady: resetScrollbar,

        handleResize: resetScrollbar

    };

    return LayoutResetScrollbars;

});