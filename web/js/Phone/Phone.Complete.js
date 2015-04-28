'use strict';

define(['./Phone'], function (Phone) {

    function complete(answerSDP, connectionId)
    {
        var remoteSessionDescription = new RTCSessionDescription(answerSDP);

        peer.setRemoteDescription(remoteSessionDescription, function(){
            alert('tak')
        }, function(error) {
            alert(error)
        });

        $.post('/phone/connection/complete/'+connectionId, function(){
            console.log('complete');
        });
    }

    var PhoneComplete = {
        complete: function(answerSDP, connectionId) {

            window.connectionId = connectionId;

            complete(answerSDP, connectionId);
        }
    };

    return PhoneComplete;

});