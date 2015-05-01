<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatController extends Controller
{
    public function indexAction($username)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $interlocutor = $userRepo->getByUsername($username);

        $title = 'Rozmowa z '.$interlocutor->getUsername();

        $settings = [
            'chat'          => true,
            'interlocutor'  => $interlocutor,
            'title'         => $title,
        ];

        if (isAjax()) {
            return new JsonResponse([
                'content'   => $this->get('twig')->render('main/chat/chat.html.twig', array_merge($settings, [
                    'ajax' => true
                ])),
                'title'     => $title,
                'userId'    => $interlocutor->getId()
            ]);
        }

        return $this->render('main/chat/chat.html.twig', $settings);
    }

}
