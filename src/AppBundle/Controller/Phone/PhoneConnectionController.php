<?php

namespace AppBundle\Controller\Phone;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhoneConnectionController extends Controller
{
    public function offerAction($userId)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $connectionOffer = $this->get('phone.connection.offer');
        /* @var $connectionOffer \Service\Phone\Connection\ConnectionOffer */

        $caller     = $this->getUser();
        $receiver   = $userRepo->get($userId);

        $call = $connectionOffer->offer($caller, $receiver, $_POST);

        return new Response($call->getConnectionId());
    }

    public function answerAction($connectionId)
    {
        $connectionAnswer = $this->get('phone.connection.answer');
        /* @var $connectionAnswer \Service\Phone\Connection\ConnectionAnswer */

        $callRepo = $this->get('call.repository');
        /* @var $callRepo \Repository\CallRepository */

        $call = $callRepo->getByConnectionId($connectionId);

        $connectionAnswer->answer($call, $_POST);

        return new Response();
    }

    public function completeAction($connectionId)
    {
        $connectionComplete = $this->get('phone.connection.complete');
        /* @var $connectionComplete \Service\Phone\Connection\ConnectionComplete */

        return new Response();
    }

    public function ICECandidateAction($userId)
    {
        $connectionICECandidate = $this->get('phone.connection.ICECandidate');
        /* @var $connectionICECandidate \Service\Phone\Connection\ConnectionICECandidate */

        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $sendTo = $userRepo->get($userId);

        $connectionICECandidate->candidate($sendTo);

        return new Response();
    }

}
