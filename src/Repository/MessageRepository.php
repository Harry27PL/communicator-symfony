<?php

namespace Repository;

use Entity\User;
use Entity\Message;
use Doctrine\ORM\EntityManager;
use Traits\RepositoryTrait;

class MessageRepository
{
    use RepositoryTrait;

    /** @var EntityManager */
    private $em;

    private $entityName = 'Entity:Message';

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /** @return Message */
    public function add(User $sender, User $receiver, $content)
    {
        $message = new Message();

        $message->setContent($content);
        $message->setReceiver($receiver);
        $message->setSender($sender);

        $this->em->persist($message);
        $this->em->flush();

        return $message;
    }

    /** @return Message[] */
    public function getAll(User $user1, User $user2)
    {
        return $this->em->createQuery('
            SELECT
                m
            FROM
                '.$this->entityName.' m
            WHERE
                ( m.sender = :user1 AND m.receiver = :user2 )
                OR
                ( m.sender = :user2 AND m.receiver = :user1 )
            ORDER BY
                m.sentAt ASC
        ')
        ->setParameter('user1', $user1)
        ->setParameter('user2', $user2)
        ->getResult()
        ;
    }

    /** @return Message[] */
    public function getUnread(User $sender)
    {
        return $this->em->createQuery('
            SELECT
                m
            FROM
                '.$this->entityName.' m
            WHERE
                m.sender = :user AND m.read = 0
        ')
        ->setParameter('user', $sender)
        ->getResult()
        ;
    }

    public function hasUnread(User $sender)
    {
        return $this->em->createQuery('
            SELECT
                COUNT(m)
            FROM
                '.$this->entityName.' m
            WHERE
                m.sender = :user AND m.read = 0
        ')
        ->setParameter('user', $sender)
        ->getSingleScalarResult()
        ;
    }

}
