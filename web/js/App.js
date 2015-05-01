'use strict';

define(function() {

    var App = {};

    App.dispatch = function(name){

        $(App).trigger(name);
        
    };

    return App;

});