'use strict';

$(document).ready(function () {

    var client, clientAuth;
    client = new Faye.Client('http://'+window.location.hostname+':8000/faye', {
        timeout: 10
    });

    var clientAuth = {
        outgoing: function (message, callback) {
            if (message.channel !== '/meta/subscribe')
                return callback(message);

            if (!message.ext)
                message.ext = {};

            message.ext.authToken = fayeConfig.token;

            callback(message);
        }
    };

    client.addExtension(clientAuth);

    client.subscribe('/'+fayeConfig.id, function(data) {

        alert(data.type)
        alert(data.data)

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
