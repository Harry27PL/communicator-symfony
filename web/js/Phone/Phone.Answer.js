'use strict';

define(['./Phone'], function (Phone) {

    var sdpConstraints = {
        optional: [],
        mandatory: {
            OfferToReceiveAudio: true,
            OfferToReceiveVideo: true
        }
    };

    function answer(offerSDP, connectionId)
    {
        var remoteSessionDescription = new RTCSessionDescription(offerSDP);

        Phone.connection.setRemoteDescription(remoteSessionDescription);

        Phone.connection.createAnswer(function(answerSDP) {

            Phone.connection.setLocalDescription(answerSDP);

            $.post('/phone/connection/answer/'+connectionId, answerSDP, function(d){
                alert(d)
            });

        }, function(){}, sdpConstraints);
    }

    var PhoneAnswer = {
        answer: function(offerSDP, connectionId) {
            answer(offerSDP, connectionId);
        }
    };

    return PhoneAnswer;

});