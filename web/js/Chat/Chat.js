'use strict';

define(['../App',  '../ContactList/ContactList'],
function (App,      ContactList) {

    function load(url)
    {
        $.post(url, function(d){

            $('title').html(d.title);

            ContactList.setActive(d.userId);

            $('.layout-main-chat').html(d.content);

            App.dispatch('chatChange');

        });
    }

    var Chat = {
        load: function(url) {
            load(url);
        }
    };

    return Chat;

});