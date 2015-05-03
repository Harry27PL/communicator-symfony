<?php

namespace Service\Chat\Phone;

use Entity\Call;

class PhoneAnswer extends Phone
{
    public function answer(Call $call, $answerSDP)
    {
        $this->faye->send($call->getCaller(), 'phone.answer', [
            'answerSDP'     => $answerSDP,
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
