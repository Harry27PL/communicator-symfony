'use strict';

define([], function () {

    var connection = RTCPeerConnection({
        iceServers: [{
            url: 'stun:stun.l.google.com:19302'
        }]
    });

    var Phone = {
        connection: connection
    };

    return Phone;

});