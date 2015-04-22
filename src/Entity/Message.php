<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Channel", inversedBy="messages")
     */
    protected $channel;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messagesSent")
     */
    protected $sender;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messagesReceived")
     */
    protected $receiver;
    

    //

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    //

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

}