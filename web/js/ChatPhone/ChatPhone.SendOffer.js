'use strict';

define(['./ChatPhone'],
function (ChatPhone) {

    function sendOffer(to, video)
    {
        callVideo = video;
        isCalling = true;

        ChatPhone.askForUserMedia(function(mediaStream){

            ChatPhone.createPeer(mediaStream, to);

            peer.createOffer(function(offerSDP)
            {
                peer.setLocalDescription(offerSDP);

                $.post('/chat/phone/connection/offer/'+(video ? 'video' : 'audio')+'/'+to, offerSDP, function(){
                    console.log('offer');
                });

            }, function(){}, ChatPhone.getSdpConstraints(video));

        }, video);
    }

    var ChatPhoneSendOffer = {

        sendOffer: sendOffer

    };

    return ChatPhoneSendOffer;

});