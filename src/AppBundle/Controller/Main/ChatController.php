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

        $messageRepo = $this->get('message.repository');
        /* @var $messageRepo \Repository\MessageRepository */

        $interlocutor = $userRepo->getByUsername($username);

        $user = $this->getUser();

        $messages = $messageRepo->getAll($user, $interlocutor);

        $title = 'Rozmowa z '.$interlocutor->getUsername();

        $settings = [
            'chat'          => true,
            'interlocutor'  => $interlocutor,
            'title'         => $title,
            'messages'      => $messages
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
