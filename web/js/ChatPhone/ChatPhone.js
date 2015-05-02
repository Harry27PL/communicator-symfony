'use strict';

define([], function () {

    var iceServers = {
        iceServers: [{
            url: 'stun:stun.l.google.com:19302'
        }]
    };

    function getSdpConstraints(video)
    {
        return video
            ? {
                optional: [],
                mandatory: {
                    OfferToReceiveAudio: true,
                    OfferToReceiveVideo: true
                }
            }
            : {
                optional: [],
                mandatory: {
                    OfferToReceiveAudio: true,
                    OfferToReceiveVideo: false
                }
            };
    }


    function askForUserMedia(callback, video)
    {
        var MediaConstraints = {
            audio: true,
            video: video
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

            $.post('/chat/phone/connection/icecandidate/'+otherUserId, candidate, function(d){
                //alert(d)
            });
        };
    }

    var ChatPhone = {

        askForUserMedia: askForUserMedia,

        createPeer: createPeer,

        getSdpConstraints: getSdpConstraints

    };

    return ChatPhone;

});