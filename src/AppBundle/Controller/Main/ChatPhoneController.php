<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatPhoneController extends Controller
{
    public function offerAction($userId, $video)
    {
        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $connectionOffer = $this->get('chat.phone.offer');
        /* @var $connectionOffer \Service\Chat\Phone\PhoneOffer */

        $caller     = $this->getUser();
        $receiver   = $userRepo->get($userId);

        $call = $connectionOffer->offer($caller, $receiver, $_POST, $video);

        return new Response($call->getConnectionId());
    }

    public function rejectAction($connectionId)
    {
        $connectionReject = $this->get('chat.phone.reject');
        /* @var $connectionReject \Service\Chat\Phone\PhoneReject */

        $callRepo = $this->get('call.repository');
        /* @var $callRepo \Repository\CallRepository */

        $call = $callRepo->getByConnectionId($connectionId);

        $connectionReject->reject($call);

        return new Response();
    }

    public function answerAction($connectionId)
    {
        $connectionAnswer = $this->get('chat.phone.answer');
        /* @var $connectionAnswer \Service\Chat\Phone\PhoneAnswer */

        $callRepo = $this->get('call.repository');
        /* @var $callRepo \Repository\CallRepository */

        $call = $callRepo->getByConnectionId($connectionId);

        $connectionAnswer->answer($call, $_POST);

        return new Response();
    }

    public function completeAction($connectionId)
    {
        $connectionComplete = $this->get('chat.phone.complete');
        /* @var $connectionComplete \Service\Chat\Phone\PhoneComplete */

        $callRepo = $this->get('call.repository');
        /* @var $callRepo \Repository\CallRepository */

        $call = $callRepo->getByConnectionId($connectionId);

        $connectionComplete->complete($call);

        return new Response();
    }

    public function ICECandidateAction($userId)
    {
        $connectionICECandidate = $this->get('chat.phone.ICECandidate');
        /* @var $connectionICECandidate \Service\Chat\Phone\PhoneICECandidate */

        $userRepo = $this->get('user.repository');
        /* @var $userRepo \Repository\UserRepository */

        $sendTo = $userRepo->get($userId);

        $connectionICECandidate->candidate($sendTo);

        return new Response();
    }

    public function hangUpAction($connectionId)
    {
        $connectionHangUp = $this->get('chat.phone.hangUp');
        /* @var $connectionHangUp \Service\Chat\Phone\PhoneHangUp */

        $callRepo = $this->get('call.repository');
        /* @var $callRepo \Repository\CallRepository */

        $call = $callRepo->getByConnectionId($connectionId);

        $user = $this->getUser();

        $connectionHangUp->hangUp($call, $user);

        return new Response();
    }

}
