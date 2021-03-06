'use strict';

define(['./ChatPhone', '../ContactList/ContactList'],
function (ChatPhone,   ContactList) {

    function sendAnswer(offerSDP, connectionId, callerId, video, mediaStream, callback)
    {
        ChatPhone.createPeer(mediaStream, callerId);

        var remoteSessionDescription = new RTCSessionDescription(offerSDP);

        peer.setRemoteDescription(remoteSessionDescription, function(){

            peer.createAnswer(function(answerSDP) {

                peer.setLocalDescription(answerSDP);

                $.post('/chat/phone/connection/answer/'+connectionId, {
                    type: 'answer',
                    sdp: answerSDP.sdp
                });

                ContactList.clearCalling(callerId);

                ChatPhone.start(video);

                callback();

            }, function(){}, ChatPhone.getSdpConstraints(video));

        });

    }

    function answer(interlocutorId, callback)
    {
        var offer = offers[interlocutorId];

        callVideo = offer.video;

        ChatPhone.askForUserMedia(function(mediaStream){
            sendAnswer(offer.sdp, offer.connectionId, interlocutorId, offer.video, mediaStream, callback);
        }, offer.video);
    }

    var ChatPhoneAnswer = {
        answer: answer
    };

    return ChatPhoneAnswer;

});