'use strict';

define(['../App', 'ChatPhone/Phone.Offer'],
function (App,     PhoneOffer) {

    function handleClick(target)
    {
        PhoneOffer.offer($(target).attr('data-to'));
    }

    var CallButton = {
        handleClick: function(e) {
            e.preventDefault;
            handleClick(e.target);
        }
    };

    return CallButton;

});