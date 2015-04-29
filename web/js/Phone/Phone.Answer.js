'use strict';

define(['./Phone'], function (Phone) {

    function sendAnswer(offerSDP, connectionId, callerId, mediaStream)
    {
        var sdpConstraints = {
            optional: [],
            mandatory: {
                OfferToReceiveAudio: true,
                OfferToReceiveVideo: true
            }
        };

        Phone.createPeer(mediaStream, callerId);

        var remoteSessionDescription = new RTCSessionDescription(offerSDP);

        peer.setRemoteDescription(remoteSessionDescription);

        peer.createAnswer(function(answerSDP) {

            peer.setLocalDescription(answerSDP);

            $.post('/phone/connection/answer/'+connectionId, answerSDP, function(){
                console.log('answer');
            });

        }, function(){}, sdpConstraints);
    }

    function answer(offerSDP, connectionId, callerId)
    {
        Phone.askForUserMedia(function(mediaStream){
            sendAnswer(offerSDP, connectionId, callerId, mediaStream);
        });
    }

    var PhoneAnswer = {
        answer: function(offerSDP, connectionId, callerId) {
            answer(offerSDP, connectionId, callerId);
        }
    };

    return PhoneAnswer;

});