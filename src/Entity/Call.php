<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Calls")
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="outgoingCalls")
     */
    protected $caller;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incomingCalls")
     */
    protected $receiver;

    //

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10)
     */
    protected $connectionId;

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



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set calledAt
     *
     * @param \DateTime $calledAt
     * @return Call
     */
    public function setCalledAt($calledAt)
    {
        $this->calledAt = $calledAt;

        return $this;
    }

    /**
     * Get calledAt
     *
     * @return \DateTime
     */
    public function getCalledAt()
    {
        return $this->calledAt;
    }

    /**
     * Set endedAt
     *
     * @param \DateTime $endedAt
     * @return Call
     */
    public function setEndedAt($endedAt)
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * Get endedAt
     *
     * @return \DateTime
     */
    public function getEndedAt()
    {
        return $this->endedAt;
    }

    /**
     * Set caller
     *
     * @param \Entity\User $caller
     * @return Call
     */
    public function setCaller(\Entity\User $caller = null)
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * Get caller
     *
     * @return \Entity\User
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * Set receiver
     *
     * @param \Entity\User $receiver
     * @return Call
     */
    public function setReceiver(\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \Entity\User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set connectionId
     *
     * @param string $connectionId
     * @return Call
     */
    public function setConnectionId($connectionId)
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    /**
     * Get connectionId
     *
     * @return string
     */
    public function getConnectionId()
    {
        return $this->connectionId;
    }
}
