<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {

        return $this->render('main/main.html.twig', [
            'title' => 'Komunikator'
        ]);
    }

}
