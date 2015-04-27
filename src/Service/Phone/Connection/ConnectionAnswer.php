<?php

namespace Service\Phone\Connection;

use Entity\Call;

class ConnectionAnswer extends Connection
{
    public function answer(Call $call, $answerSDP)
    {
        $this->faye->send($call->getCaller(), 'phone.connection.answer', [
            'answerSDP'     => $answerSDP,
            'connectionId'  => $call->getConnectionId()
        ]);
    }

}
