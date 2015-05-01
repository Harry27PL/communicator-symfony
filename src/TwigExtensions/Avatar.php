<?php

namespace TwigExtensions;

use Entity\User;

class Avatar extends \Twig_Extension
{
    private $environment;

    public function __construct()
    {

    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getName()
    {
        return 'avatar';
    }

    public function getFunctions()
    {
        return array(
            'avatar'    => new \Twig_Function_Method($this, 'getAvatar',   array('is_safe' => array('html'))),
        );
    }

    public function getAvatar(User $user)
    {
        $hash = md5(strtolower($user->getEmail()));

        $url = 'http://www.gravatar.com/avatar/'.$hash.'?d=mm&s=200';

        return '<img src="'.$url.'">';
    }
}