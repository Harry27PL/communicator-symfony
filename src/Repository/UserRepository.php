<?php

namespace Repository;

use Entity\User;
use Doctrine\ORM\EntityManager;
use Traits\RepositoryTrait;

class UserRepository
{
    use RepositoryTrait;

    /** @var EntityManager */
    private $em;

    private $encoder;

    private $entityName = 'Entity:User';

    public function __construct(EntityManager $em, $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /** @return User */
    public function get($id)
    {
        return $this->em->getRepository($this->entityName)->find($id);
    }

    /** @return User */
    public function getByEmail($email)
    {
        return $this->em->getRepository($this->entityName)->findOneByEmail($email);
    }

    /** @return User */
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

    public function getAllWithout(User $user)
    {
        return $this->em->createQuery('
            SELECT
                u
            FROM
                '.$this->entityName.' u
            WHERE
                u <> :user
            ')
            ->setParameter('user', $user)
            ->getResult();
    }
}
