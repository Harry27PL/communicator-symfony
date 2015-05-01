'use strict';

define([], function (PhoneOffer) {

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