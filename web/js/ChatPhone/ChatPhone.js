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

            callMediaStream = mediaStream.stream;
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

    var ring = new Audio('/sounds/phone.mp3');
    ring.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);

    function startRing()
    {
        ring.play();
    }

    function stopRing()
    {
        ring.pause();
    }

    function start(video)
    {
        isCalling = true;

        callVideo = video;
    }

    function stop()
    {
        isCalling = false;

        peer.close();

        peer = null;

        callMediaStream.stop();
        callMediaStream.src = null;
    }

    var ChatPhone = {

        askForUserMedia: askForUserMedia,

        createPeer: createPeer,

        getSdpConstraints: getSdpConstraints,

        startRing: startRing,
        stopRing:  stopRing,

        start: start,
        stop:  stop

    };

    return ChatPhone;

});