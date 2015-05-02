'use strict';

define(['./Phone'], function (Phone) {

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
    }

    var PhoneComplete = {
        complete: function(answerSDP, connectionId) {

            complete(answerSDP, connectionId);
        }
    };

    return PhoneComplete;

});