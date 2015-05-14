'use strict';

var peer,
    addICEIntervals = [],
    isCalling = false,
    callVideo,
    callMediaStream,
    offers = [];

$(document).ready(function () {

    require.config({
        baseUrl: '/js',
        paths: {
            jquery: 'empty:'
        }
    });

    requirejs(['AppEvents', 'FayeEvents', 'HTMLEvents', 'HistoryEvents'],
    function (  AppEvents,   FayeEvents,   HTMLEvents,   HistoryEvents) {

    });

});

function print_r(o) {
    function f(o, p, s) {
        for (var x in o) {
            if ('object' == typeof o[x]) {
                s += p + x + ' obiekt: \n';
                pre = p + '\t';
                s = f(o[x], pre, s);
            } else {
                s += p + x + ' : ' + o[x] + '\n';
            }
        }
        return s;
    }
    return f(o, '', '');
}

$(document).ajaxError(function(e, xhr, settings, exception) {
    if (!$('.ajaxBlad').length)
        $('html').prepend('<div class="ajaxBlad" style="background:#eee"></div>');

    $('.ajaxBlad').append('<br><b>' + settings.url + '</b><br> ' + xhr.responseText);
});