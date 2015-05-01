<?php

namespace Service\Chat\Phone\Connection;

use Service\Faye\Faye;
use Repository\CallRepository;

abstract class Connection
{
    /** @var CallRepository */
    protected $callRepo;

    /** @var Faye */
    protected $faye;

    public function __construct(Faye $faye, CallRepository $callRepo)
    {
        $this->faye = $faye;
        $this->callRepo = $callRepo;
    }

}
