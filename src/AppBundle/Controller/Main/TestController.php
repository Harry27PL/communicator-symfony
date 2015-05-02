<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();

        $faye = $this->get('faye');

        $faye->send($user, 'addUser');

        return new Response();
    }

}
