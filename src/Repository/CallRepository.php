<?php

namespace Repository;

use Entity\User;
use Entity\Call;
use Doctrine\ORM\EntityManager;

class CallRepository
{
    /** @var EntityManager */
    private $em;

    private $entityName = 'Entity:Call';

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /** @return Call */
    public function add(User $caller, User $receiver)
    {
        $call = new Call();

        $call->setCalledAt(new \DateTime());
        $call->setCaller($caller);
        $call->setReceiver($receiver);
        $call->setConnectionId(randomString(10));

        $this->em->persist($call);
        $this->em->flush();

        return $call;
    }

    /** @return Call */
    public function getByConnectionId($connectionId)
    {
        return $this->em->getRepository($this->entityName)->findOneByConnectionId($connectionId);
    }

}
