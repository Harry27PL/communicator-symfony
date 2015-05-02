<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaintainOnlineController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();

        $maintainOnline = $this->get('user.maintainOnline');
        /* @var $maintainOnline \Service\User\UserMaintainOnline */

        $maintainOnline->maintainOnline($user);

        return new Response();
    }

}
