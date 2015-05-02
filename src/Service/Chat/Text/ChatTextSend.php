<?php

namespace Service\Chat\Text;

use Entity\User;
use Entity\Message;
use Service\Faye\Faye;
use Repository\MessageRepository;

class ChatTextSend
{
    private $twig;

    /** @var Faye */
    private $faye;

    /** @var MessageRepository */
    private $messageRepo;

    public function __construct(MessageRepository $messageRepo, Faye $faye, $twig)
    {
        $this->messageRepo  = $messageRepo;
        $this->twig         = $twig;
        $this->faye         = $faye;
    }

    public function send(User $sender, User $receiver, $content)
    {
        $message = $this->messageRepo->add($sender, $receiver, $content);

        $this->sendTo($sender, $receiver, $message);
        $this->sendTo($receiver, $sender, $message);
    }

    private function sendTo(User $user, User $interlocutor, Message $message)
    {
        $template = 'main/chat/text/message.html.twig';

        $this->faye->send($user, 'chatText.message', [
            'interlocutor'  => $interlocutor->getId(),
            'content'       => $this->twig->render($template, [
                'message'   => $message,
                'user'      => $user
            ])
        ]);
    }

}
