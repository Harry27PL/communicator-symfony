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
        $('.contact.active').removeClass('active');
        $('.contact[data-id='+userId+']').addClass('active');
    }

    function setOnline(userId)
    {
        $('.contact[data-id='+userId+']').addClass('online');
    }

    function setOffline(userId)
    {
        $('.contact[data-id='+userId+']').removeClass('online');
    }

    function getContact(userId)
    {
        return $('.contact[data-id='+userId+']');
    }

    function setUnreadMessage(userId)
    {
        getContact(userId).find('.contact-icons-message').removeClass('hidden');
    }

    function clearUnreadMessage(userId)
    {
        getContact(userId).find('.contact-icons-message').addClass('hidden');
    }

    function setCalling(userId)
    {
        getContact(userId).find('.contact-icons-call').removeClass('hidden');
    }

    function clearCalling(userId)
    {
        getContact(userId).find('.contact-icons-call').addClass('hidden');
    }

    var ContactList = {
        handleClick: function(e) {
            e.preventDefault();
            handleClick(e.target);
        },

        setActive:          setActive,
        setOnline:          setOnline,
        setOffline:         setOffline,
        setUnreadMessage:   setUnreadMessage,
        clearUnreadMessage: clearUnreadMessage,
        setCalling:         setCalling,
        clearCalling:       clearCalling
    };

    return ContactList;

});