'use strict';

define(['./Phone'], function (Phone) {

    function offer(to)
    {
        var sdpConstraints = {
            optional: [],
            mandatory: {
                OfferToReceiveAudio: true,
                OfferToReceiveVideo: true
            }
        };

        Phone.connection.createOffer(function(offerSDP)
        {
            Phone.connection.setLocalDescription(offerSDP);

            $.post('/phone/connection/offer/'+to, offerSDP);

        }, function(){}, sdpConstraints);

    }

    //

    //var remoteSessionDescription = new RTCSessionDescription(answerSDP);
    //connection.setRemoteDescription(remoteSessionDescription);


    var PhoneOffer = {
        offer: function(to) {
            offer(to);
        }
    };

    return PhoneOffer;

});