<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Call
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
     * @ORM\ManyToOne(targetEntity="Channel", inversedBy="calls")
     */
    protected $channel;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="outgoingCalls")
     */
    protected $caller;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incomingCalls")
     */
    protected $receiver;

    //

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $calledAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endedAt;


}