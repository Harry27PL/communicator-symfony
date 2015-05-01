<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatPhoneController extends Controller
{
    public function offerAction($userId)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $connectionOffer = $this->get('chat.phone.connection.offer');
        /* @var $connectionOffer \Service\Chat\Phone\Connection\ConnectionOffer */

        $caller     = $this->getUser();
        $receiver   = $userRepo->get($userId);

        $call = $connectionOffer->offer($caller, $receiver, $_POST);

        return new Response($call->getConnectionId());
    }

    public function answerAction($connectionId)
    {
        $connectionAnswer = $this->get('chat.phone.connection.answer');
        /* @var $connectionAnswer \Service\Chat\Phone\Connection\ConnectionAnswer */

        $callRepo = $this->get('call.repository');
        /* @var $callRepo \Repository\CallRepository */

        $call = $callRepo->getByConnectionId($connectionId);

        $connectionAnswer->answer($call, $_POST);

        return new Response();
    }

    public function completeAction($connectionId)
    {
        $connectionComplete = $this->get('chat.phone.connection.complete');
        /* @var $connectionComplete \Service\Chat\Phone\Connection\ConnectionComplete */

        return new Response();
    }

    public function ICECandidateAction($userId)
    {
        $connectionICECandidate = $this->get('chat.phone.connection.ICECandidate');
        /* @var $connectionICECandidate \Service\Chat\Phone\Connection\ConnectionICECandidate */

        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $sendTo = $userRepo->get($userId);

        $connectionICECandidate->candidate($sendTo);

        return new Response();
    }

}
