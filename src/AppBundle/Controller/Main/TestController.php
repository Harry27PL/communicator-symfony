<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        $faye = $this->get('faye');
        $faye->sendToAll('call');

        return new Response();
    }

}
