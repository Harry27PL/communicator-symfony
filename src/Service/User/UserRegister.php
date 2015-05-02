<?php

namespace Service\User;

use Entity\User;
use Repository\UserRepository;
use Service\Faye\Faye;

class UserRegister
{
    /** @var Faye */
    private $faye;

    private $twig;

    /** @var UserLogAs */
    private $logAs;

    /** @var UserRepository */
    private $repo;

    public function __construct(UserRepository $repo, UserLogAs $logAs, Faye $faye, $twig)
    {
        $this->repo  = $repo;
        $this->logAs = $logAs;
        $this->twig  = $twig;
        $this->faye  = $faye;
    }

    public function register($username, $email, $password)
    {
        $user = $this->repo->add($username, $email, $password);

        $this->logAs->logAs($user);

        $this->refreshContactList();
    }

    public function getDefaultValues()
    {
        return [
            'username'  => '',
            'email'     => '',
            'password'  => '',
        ];
    }

    public function validate($username, $email, $password)
    {
        $errors = $this->getDefaultValues();
        $values = $this->getDefaultValues();

        $values['username'] = $username;
        $values['email']    = $email;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'user.validate.email.incorrect';
        else if ($this->repo->getByEmail($email))
            $errors['email'] = 'user.validate.email.exists';

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

    private function refreshContactList()
    {
        $users = $this->repo->getAll();

        foreach ($users as $user) {

            $this->faye->send($user, 'addUser');

        }
    }
}
