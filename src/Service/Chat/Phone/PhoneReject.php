<?php

namespace Service\Chat\Phone;

use Entity\Call;

class PhoneReject extends Phone
{
    public function reject(Call $call)
    {
        $this->faye->send($call->getCaller(), 'phone.reject', [
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
