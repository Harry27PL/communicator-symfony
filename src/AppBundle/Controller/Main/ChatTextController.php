<?php

namespace AppBundle\Controller\Main\ChatText;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatTextController extends Controller
{
    public function sendAction($userId)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $user = $this->getUser();
        /* @var User $user */

        $chatTextSend = $this->get('chat.text.send');
        /* @var $chatTextSend \Service\Chat\Text\ChatTextSend */

        $receiver   = $userRepo->get($userId);

        $chatTextSend->send($user, $receiver, $_POST['content']);

        return new Response();
    }

}
