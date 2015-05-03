<?php

namespace Service\Chat\Phone;

use Entity\Call;
use Entity\User;

class PhoneHangUp extends Phone
{
    public function hangUp(Call $call, User $by)
    {
        $sendTo = $call->getReceiver() == $by
            ? $call->getCaller()
            : $call->getReceiver();

        $this->faye->send($sendTo, 'phone.hangUp', [
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
