<?php

namespace Service\Chat\Phone;

use Entity\Call;

class PhoneAnswer extends Phone
{
    public function answer(Call $call, $answerSDP)
    {
        $call->setAnsweredAt(new \DateTime());

        $this->callRepo->update();

        $this->faye->send($call->getCaller(), 'phone.answer', [
            'answerSDP'     => $answerSDP,
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
