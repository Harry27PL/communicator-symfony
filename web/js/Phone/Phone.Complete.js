'use strict';

define(['./Phone'], function (Phone) {

    function complete(answerSDP, connectionId)
    {
        var remoteSessionDescription = new RTCSessionDescription(answerSDP);

        Phone.connection.setRemoteDescription(remoteSessionDescription);

        $.post('/phone/connection/complete/'+connectionId, function(d){
            alert(d);
        });
    }

    var PhoneComplete = {
        complete: function(answerSDP, connectionId) {
            complete(answerSDP, connectionId);
        }
    };

    return PhoneComplete;

});