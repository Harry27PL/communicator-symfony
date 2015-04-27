<?php

namespace Service\Phone\Connection;

use Entity\User;

class ConnectionOffer extends Connection
{
    public function offer(User $caller, User $receiver, $offerSDP)
    {
        $call = $this->callRepo->add($caller, $receiver);

        $this->faye->send($receiver, 'phone.connection.offer', [
            'offerSDP'      => $offerSDP,
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
