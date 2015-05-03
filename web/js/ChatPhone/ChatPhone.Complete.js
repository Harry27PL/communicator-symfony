'use strict';

define(['../Chat/Chat', './ChatPhone', './ChatPhone.Dialer'],
function (Chat,         ChatPhone,     ChatPhoneDialer) {

    function complete(answerSDP, connectionId)
    {
        offers[Chat.getInterlocutorId()] = {
            sdp:          answerSDP,
            video:        callVideo,
            connectionId: connectionId
        };

        var remoteSessionDescription = new RTCSessionDescription(answerSDP);

        peer.setRemoteDescription(remoteSessionDescription, function(){

        }, function(error) {
            console.log(error);
        });

        $.post('/chat/phone/connection/complete/'+connectionId, function(){
            console.log('complete');
        });

        ChatPhoneDialer.startChat();
    }

    var ChatPhoneComplete = {
        complete: function(answerSDP, connectionId) {

            complete(answerSDP, connectionId);
        }
    };

    return ChatPhoneComplete;

});