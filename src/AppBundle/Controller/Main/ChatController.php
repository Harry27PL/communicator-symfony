<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatController extends Controller
{
    public function indexAction($username)
    {
        $userRepo        = $this->get('user.repository');
        $messageRepo     = $this->get('message.repository');
        $chatTextSetRead = $this->get('chat.text.setRead');
        /* @var $userRepo \Repository\UserRepository */
        /* @var $messageRepo \Repository\MessageRepository */
        /* @var $chatTextSetRead \Service\Chat\Text\ChatTextSetRead */

        $interlocutor = $userRepo->getByUsername($username);

        $user = $this->getUser();

        $chatTextSetRead->setReadAll($interlocutor);

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
