'use strict';

define(['./ChatPhone'],
function (ChatPhone) {

    function sendOffer(to, video)
    {
        ChatPhone.start(video);

        ChatPhone.askForUserMedia(function(mediaStream){

            ChatPhone.createPeer(mediaStream, to);

            peer.createOffer(function(offerSDP)
            {
                peer.setLocalDescription(offerSDP);

                $.post('/chat/phone/connection/offer/'+(video ? 'video' : 'audio')+'/'+to, {
                    type: 'offer',
                    sdp: offerSDP.sdp
                });

            }, function(){}, ChatPhone.getSdpConstraints(video));

        }, video);
    }

    var ChatPhoneSendOffer = {

        sendOffer: sendOffer

    };

    return ChatPhoneSendOffer;

});