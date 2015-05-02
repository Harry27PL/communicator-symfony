<?php

namespace Service\User;

use Entity\User;
use Service\Faye\Faye;
use Repository\UserRepository;

class UserMaintainOnline
{
    /** @var Faye */
    private $faye;

    /** @var UserRepository */
    private $userRepo;

    public function __construct(UserRepository $userRepo, Faye $faye)
    {
        $this->userRepo = $userRepo;
        $this->faye = $faye;
    }

    public function maintainOnline(User $user)
    {
        $otherUsers = $this->userRepo->getAllWithout($user);

        foreach ($otherUsers as $otherUser) {

            $this->faye->send($otherUser, 'online', $user->getId());

        }
    }

}
