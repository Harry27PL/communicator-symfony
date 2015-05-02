'use strict';

define(['./ChatPhone', './ChatPhone.Dialer'],
function (ChatPhone,   ChatPhoneDialer) {

    function sendAnswer(offerSDP, connectionId, callerId, mediaStream, video)
    {
        ChatPhone.createPeer(mediaStream, callerId);

        var remoteSessionDescription = new RTCSessionDescription(offerSDP);

        peer.setRemoteDescription(remoteSessionDescription);

        peer.createAnswer(function(answerSDP) {

            peer.setLocalDescription(answerSDP);

            $.post('/chat/phone/connection/answer/'+connectionId, answerSDP, function(){
                console.log('answer');
            });

            ChatPhoneDialer.startChat();

        }, function(){}, ChatPhone.getSdpConstraints(video));
    }

    function answer(offerSDP, connectionId, callerId, video)
    {
        callVideo = video;

        ChatPhone.askForUserMedia(function(mediaStream){
            sendAnswer(offerSDP, connectionId, callerId, mediaStream, video);
        }, video);
    }

    var ChatPhoneAnswer = {
        answer: answer
    };

    return ChatPhoneAnswer;

});