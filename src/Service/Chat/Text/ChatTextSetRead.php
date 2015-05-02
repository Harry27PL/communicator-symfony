<?php

namespace Service\Chat\Text;

use Entity\User;
use Entity\Message;
use Repository\MessageRepository;

class ChatTextSetRead
{
    /** @var MessageRepository */
    private $messageRepo;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepo  = $messageRepo;
    }

    public function setRead(Message $message)
    {
        $message->setRead(true);

        $this->messageRepo->update();
    }

    public function setReadAll(User $interlocutor)
    {
        $messages = $this->messageRepo->getUnread($interlocutor);

        foreach ($messages as $message) {

            $this->setRead($message);

        }
    }

}
