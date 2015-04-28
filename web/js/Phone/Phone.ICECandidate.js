'use strict';

define(['./Phone'],
function (Phone) {

    var candidates = [];

    function addCandidate(sdpMLineIndex, sdpMid, candidate)
    {
        setTimeout(function(){

            //candidates.push();

            peer.addIceCandidate(new RTCIceCandidate({
                sdpMLineIndex:  sdpMLineIndex,
                candidate:      candidate
            }));

            console.log('ice');

        }, 1000)
    }

    var PhoneICECandidate = {
        addCandidate: function(sdpMLineIndex, sdpMid, candidate) {
            addCandidate(sdpMLineIndex, sdpMid, candidate);
        }
    };

    return PhoneICECandidate;

});