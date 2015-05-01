<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserPanelController extends Controller
{
    public function indexAction()
    {

        return $this->render('main/userPanel.html.twig');
    }

}
