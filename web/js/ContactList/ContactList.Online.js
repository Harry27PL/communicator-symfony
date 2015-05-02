'use strict';

define(['../App', './ContactList'],
function (App,    ContactList) {

    var logged = [];

    function setOnline(userId)
    {
        ContactList.setOnline(userId);

        if (logged[userId])
            clearTimeout(logged[userId]);

        logged[userId] = setTimeout(function(){
            ContactList.setOffline(userId);
        }, 10000);
    }

    setInterval(function(){

        $.post('/maintainOnline');

    }, 2000);

    var ContactListOnline = {
        setOnline: setOnline
    };

    return ContactListOnline;

});