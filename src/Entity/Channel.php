<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="removedAt", timeAware=false)
 */
class Channel
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
     * @ORM\ManyToMany(targetEntity="User", inversedBy="connectedChannels")
     */
    protected $members;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdChannels")
     */
    protected $creator;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="channel")
     */
    protected $messages;

    /**
     * @ORM\OneToMany(targetEntity="Call", mappedBy="channel")
     */
    protected $calls;

    //

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, unique=true)
     */
    protected $name;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $isPublic = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $removedAt = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calls = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Channel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     * @return Channel
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set removedAt
     *
     * @param \DateTime $removedAt
     * @return Channel
     */
    public function setRemovedAt($removedAt)
    {
        $this->removedAt = $removedAt;

        return $this;
    }

    /**
     * Get removedAt
     *
     * @return \DateTime 
     */
    public function getRemovedAt()
    {
        return $this->removedAt;
    }

    /**
     * Add members
     *
     * @param \Entity\User $members
     * @return Channel
     */
    public function addMember(\Entity\User $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Entity\User $members
     */
    public function removeMember(\Entity\User $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set creator
     *
     * @param \Entity\User $creator
     * @return Channel
     */
    public function setCreator(\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Add messages
     *
     * @param \Entity\Message $messages
     * @return Channel
     */
    public function addMessage(\Entity\Message $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \Entity\Message $messages
     */
    public function removeMessage(\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add calls
     *
     * @param \Entity\Call $calls
     * @return Channel
     */
    public function addCall(\Entity\Call $calls)
    {
        $this->calls[] = $calls;

        return $this;
    }

    /**
     * Remove calls
     *
     * @param \Entity\Call $calls
     */
    public function removeCall(\Entity\Call $calls)
    {
        $this->calls->removeElement($calls);
    }

    /**
     * Get calls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalls()
    {
        return $this->calls;
    }
}
