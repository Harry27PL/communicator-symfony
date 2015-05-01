'use strict';

var peer,
    addICEIntervals = [];

$(document).ready(function () {

    require.config({
        //perfectScrollbar: '/bower_components/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js',
        baseUrl: '/js',
        paths: {
            jquery: 'empty:'
        }
    });

    requirejs(['FayeEvents', 'HTMLEvents'],
    function (FayeEvents, HTMLEvents) {


    });

    //


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