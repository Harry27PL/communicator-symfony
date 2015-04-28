'use strict';

define([], function () {

    var iceServers = {
        iceServers: [{
            url: 'stun:stun.l.google.com:19302'
        }]
    };

    function askForUserMedia(callback)
    {
        var MediaConstraints = {
            audio: true,
            video: true
        };

        getUserMedia(MediaConstraints, function(mediaStream) {
            callback(mediaStream);
        }, function(error){
            console.log(error);
        });
    }


    function createPeer(mediaStream, otherUserId)
    {
        peer = new RTCPeerConnection(iceServers);

        peer.addStream(mediaStream);

        peer.onaddstream = function(mediaStream) {

            console.log(URL.createObjectURL(mediaStream.stream));

            $('video').attr('src', URL.createObjectURL(mediaStream.stream));
        };

        peer.onicecandidate = function(event)
        {
            var candidate = event.candidate;
            if (!candidate)
                return;

            $.post('/phone/connection/icecandidate/'+otherUserId, candidate, function(d){
                //alert(d)
            });
        };
    }

    var Phone = {

        askForUserMedia: function(callback) {
            askForUserMedia(callback);
        },

        createPeer: function (mediaStream, otherUserId) {
            createPeer(mediaStream, otherUserId);
        }
    };

    return Phone;

});