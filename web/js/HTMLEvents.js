'use strict';

define([
    'Control/Call.Button'
],
function (
    CallButton
) {

    $(document).on('click', '.call', function(e){
        CallButton.handleClick(e);
    });

});