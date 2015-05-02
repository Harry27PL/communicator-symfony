'use strict';

define(['../App',  '../ContactList/ContactList'],
function (App,      ContactList) {

    function load(url)
    {
        $.post(url, function(d){

            $('.layout-main-chat').removeClass('hidden');

            $('title').html(d.title);

            ContactList.setActive(d.userId);
            ContactList.clearUnreadMessage(d.userId);

            $('.layout-main-chat').html(d.content);

            App.dispatch('chatChange');

        });
    }

    function getInterlocutorId()
    {
        return $('[data-interlocutor]').attr('data-interlocutor');
    }

    var Chat = {
        load: function(url) {
            load(url);
        },

        getInterlocutorId: getInterlocutorId
    };

    return Chat;

});