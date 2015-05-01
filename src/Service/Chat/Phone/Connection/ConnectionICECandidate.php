<?php

namespace Service\Chat\Phone\Connection;

use Entity\User;

class ConnectionICECandidate extends Connection
{
    public function candidate(User $sendTo)
    {
        $this->faye->send($sendTo, 'phone.connection.ICECandidate', array_merge($_POST, [
            
        ]));
    }

}
