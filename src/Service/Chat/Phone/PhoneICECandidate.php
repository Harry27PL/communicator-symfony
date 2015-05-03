<?php

namespace Service\Chat\Phone;

use Entity\User;

class PhoneICECandidate extends Phone
{
    public function candidate(User $sendTo)
    {
        $this->faye->send($sendTo, 'phone.ICECandidate', array_merge($_POST, [
            
        ]));
    }

}
