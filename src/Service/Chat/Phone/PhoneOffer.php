<?php

namespace Service\Chat\Phone;

use Entity\User;
use Entity\Call;

class PhoneOffer extends Phone
{
    /** @return Call */
    public function offer(User $caller, User $receiver, $offerSDP, $video)
    {
        $call = $this->callRepo->add($caller, $receiver);

        $this->faye->send($receiver, 'phone.offer', [
            'offerSDP'      => $offerSDP,
            'connectionId'  => $call->getConnectionId(),
            'callerId'      => $caller->getID(),
            'video'         => $video
        ]);

        return $call;
    }

}
