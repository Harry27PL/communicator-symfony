<?php

namespace Service\Chat\Phone;

use Entity\Call;

class PhoneHangUp extends Phone
{
    public function hangUp(Call $call)
    {
        $this->faye->send($call->getCaller(), 'phone.hangUp', [
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
