'use strict';

define(['../App'],
function (App) {

    function handleClick(el)
    {
        History.pushState({
            randomData: window.Math.random(),
            type: 'chat'
        }, $('title').html(), $(el).attr('href'));
    }

    function setActive(userId)
    {
        $('.layout-sidebar-contactList .active').removeClass('active');
        $('.layout-sidebar-contactList [data-id='+userId+']').addClass('active');
    }

    var ContactList = {
        handleClick: function(e) {
            e.preventDefault();
            handleClick(e.target);
        },

        setActive: function(userId) {
            setActive(userId);
        }
    };

    return ContactList;

});