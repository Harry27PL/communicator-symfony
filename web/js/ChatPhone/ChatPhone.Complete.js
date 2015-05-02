'use strict';

define(['./ChatPhone', './ChatPhone.Dialer'],
function (ChatPhone,   ChatPhoneDialer) {

    function complete(answerSDP, connectionId)
    {
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