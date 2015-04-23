<?php

namespace Service\User;

use Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;

class UserLogAs
{
    /** @var SecurityContext */
    private $securityContext;

    /** @var Session */
    private $session;

    public function __construct(Session $session, SecurityContext $securityContext)
    {
        $this->session = $session;
        $this->securityContext = $securityContext;
    }

    public function logAs(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->securityContext->setToken($token);
        $this->session->set('_security_main', serialize($token));
    }

}
