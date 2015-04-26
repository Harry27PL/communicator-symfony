<?php

namespace Repository;

use Entity\User;
use Doctrine\ORM\EntityManager;

class UserRepository
{
    /** @var EntityManager */
    private $em;

    private $encoder;

    private $entityName = 'Entity:User';

    public function __construct(EntityManager $em, $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function getByEmail($email)
    {
        return $this->em->getRepository($this->entityName)->findOneByEmail($email);
    }

    public function getByUsername($username)
    {
        return $this->em->getRepository($this->entityName)->findOneByUsername($username);
    }

    /** @return User[] */
    public function getAll()
    {
        return $this->em->getRepository($this->entityName)->findAll();
    }

    public function add($username, $email, $password)
    {
        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword(
            $this->encoder->getEncoder($user)->encodePassword($password, $user->getSalt())
        );
        $user->setFayeToken(randomString(16));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
