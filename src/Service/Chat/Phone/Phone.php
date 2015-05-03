<?php

namespace Service\Chat\Phone;

use Service\Faye\Faye;
use Repository\CallRepository;

abstract class Phone
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
