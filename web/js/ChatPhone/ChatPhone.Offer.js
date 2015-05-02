'use strict';

define(['./ChatPhone'], function (ChatPhone) {

    function sendOffer(to, mediaStream, video)
    {
        ChatPhone.createPeer(mediaStream, to);

        peer.createOffer(function(offerSDP)
        {
            peer.setLocalDescription(offerSDP);

            $.post('/chat/phone/connection/offer/'+(video ? 'video' : 'audio')+'/'+to, offerSDP, function(){
                console.log('offer');
            });

        }, function(){}, ChatPhone.getSdpConstraints(video));
    }

    function offer(to, video)
    {
        callVideo = video;

        ChatPhone.askForUserMedia(function(mediaStream){
            sendOffer(to, mediaStream, video);
        }, video);
    }

    var ChatPhoneOffer = {
        offer: offer
    };

    return ChatPhoneOffer;

});