<?php

namespace Service\Chat\Phone\Connection;

use Entity\User;
use Entity\Call;

class ConnectionOffer extends Connection
{
    /** @return Call */
    public function offer(User $caller, User $receiver, $offerSDP, $video)
    {
        $call = $this->callRepo->add($caller, $receiver);

        $this->faye->send($receiver, 'phone.connection.offer', [
            'offerSDP'      => $offerSDP,
            'connectionId'  => $call->getConnectionId(),
            'callerId'      => $caller->getID(),
            'video'         => $video
        ]);

        return $call;
    }

}
