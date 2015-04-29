'use strict';

define(['./Phone'], function (Phone) {

    function sendOffer(to, mediaStream)
    {
        var sdpConstraints = {
            optional: [],
            mandatory: {
                OfferToReceiveAudio: true,
                OfferToReceiveVideo: true
            }
        };

        Phone.createPeer(mediaStream, to);

        peer.createOffer(function(offerSDP)
        {
            peer.setLocalDescription(offerSDP);

            $.post('/phone/connection/offer/'+to, offerSDP, function(){
                console.log('offer');
            });

        }, function(){}, sdpConstraints);
    }

    function offer(to)
    {
        Phone.askForUserMedia(function(mediaStream){
            sendOffer(to, mediaStream);
        });
    }

    var PhoneOffer = {
        offer: function(to) {
            offer(to);
        }
    };

    return PhoneOffer;

});