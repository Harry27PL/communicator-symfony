<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatController extends Controller
{
    public function indexAction($username)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $interlocutor = $userRepo->getByUsername($username);

        $settings = [
            'chat' => true,
            'interlocutor' => $interlocutor
        ];

        return $this->render('main/chat/chat.html.twig', $settings);
    }

}
