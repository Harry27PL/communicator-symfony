<?php

namespace Service\User;

use Entity\User;
use Repository\UserRepository;

class UserRegister
{
    /** @var UserLogAs */
    private $logAs;

    /** @var UserRepository */
    private $repo;

    public function __construct(UserRepository $repo, UserLogAs $logAs)
    {
        $this->repo = $repo;
        $this->logAs = $logAs;
    }

    public function register($username, $password)
    {
        $user = $this->repo->add($username, $password);

        $this->logAs->logAs($user);
    }

    public function getDefaultValues()
    {
        return [
            'username'  => '',
            'password'  => '',
        ];
    }

    public function validate($username, $password)
    {
        $errors = $this->getDefaultValues();
        $values = $this->getDefaultValues();

        $values['username'] = $username;

        if (!$username)
            $errors['username'] = 'user.validate.username.incorrect';
        else if ($this->repo->getByUsername($username))
            $errors['username'] = 'user.validate.username.exists';

        if (!$password)
            $errors['password'] = 'user.validate.password.incorrect';

        return [
            'errors' => $errors,
            'values' => $values
        ];
    }
}
