'use strict';

define(['./Phone'],
function (Phone) {

    function addCandidate(sdpMLineIndex, sdpMid, candidate)
    {
        var interval = setInterval(function(){

            try {
                peer.addIceCandidate(new RTCIceCandidate({
                    sdpMLineIndex:  sdpMLineIndex,
                    candidate:      candidate
                }));

                clearInterval(interval);

            } catch (e) {}

        }, 100);

        addICEIntervals.push(interval);
    }

    var PhoneICECandidate = {
        addCandidate: function(sdpMLineIndex, sdpMid, candidate) {
            addCandidate(sdpMLineIndex, sdpMid, candidate);
        }
    };

    return PhoneICECandidate;

});