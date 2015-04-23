<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="removedAt", timeAware=false)
 */
class User implements AdvancedUserInterface
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
     * @ORM\ManyToMany(targetEntity="Channel", inversedBy="members")
     */
    protected $connectedChannels;

    /**
     * @ORM\OneToMany(targetEntity="Channel", mappedBy="creator")
     */
    protected $createdChannels;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="sender")
     */
    protected $messagesSent;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="receiver")
     */
    protected $messagesReceived;

    /**
     * @ORM\OneToMany(targetEntity="Call", mappedBy="caller")
     */
    protected $outgoingCalls;

    /**
     * @ORM\OneToMany(targetEntity="Call", mappedBy="receiver")
     */
    protected $incomingCalls;

    //

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, unique=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $removedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $hasAvatar = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $isAdmin = false;


    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        if ($this->isAdmin)
            return array('ROLE_ADMIN');

        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function isAccountNonExpired()
    {
        return !$this->removedAt;
    }

    /**
     * @inheritDoc
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->connectedChannels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdChannels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messagesSent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messagesReceived = new \Doctrine\Common\Collections\ArrayCollection();
        $this->outgoingCalls = new \Doctrine\Common\Collections\ArrayCollection();
        $this->incomingCalls = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set removedAt
     *
     * @param \DateTime $removedAt
     * @return User
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
     * Set hasAvatar
     *
     * @param boolean $hasAvatar
     * @return User
     */
    public function setHasAvatar($hasAvatar)
    {
        $this->hasAvatar = $hasAvatar;

        return $this;
    }

    /**
     * Get hasAvatar
     *
     * @return boolean
     */
    public function getHasAvatar()
    {
        return $this->hasAvatar;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     * @return User
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Add connectedChannels
     *
     * @param \Entity\Channel $connectedChannels
     * @return User
     */
    public function addConnectedChannel(\Entity\Channel $connectedChannels)
    {
        $this->connectedChannels[] = $connectedChannels;

        return $this;
    }

    /**
     * Remove connectedChannels
     *
     * @param \Entity\Channel $connectedChannels
     */
    public function removeConnectedChannel(\Entity\Channel $connectedChannels)
    {
        $this->connectedChannels->removeElement($connectedChannels);
    }

    /**
     * Get connectedChannels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConnectedChannels()
    {
        return $this->connectedChannels;
    }

    /**
     * Add createdChannels
     *
     * @param \Entity\Channel $createdChannels
     * @return User
     */
    public function addCreatedChannel(\Entity\Channel $createdChannels)
    {
        $this->createdChannels[] = $createdChannels;

        return $this;
    }

    /**
     * Remove createdChannels
     *
     * @param \Entity\Channel $createdChannels
     */
    public function removeCreatedChannel(\Entity\Channel $createdChannels)
    {
        $this->createdChannels->removeElement($createdChannels);
    }

    /**
     * Get createdChannels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedChannels()
    {
        return $this->createdChannels;
    }

    /**
     * Add messagesSent
     *
     * @param \Entity\Message $messagesSent
     * @return User
     */
    public function addMessagesSent(\Entity\Message $messagesSent)
    {
        $this->messagesSent[] = $messagesSent;

        return $this;
    }

    /**
     * Remove messagesSent
     *
     * @param \Entity\Message $messagesSent
     */
    public function removeMessagesSent(\Entity\Message $messagesSent)
    {
        $this->messagesSent->removeElement($messagesSent);
    }

    /**
     * Get messagesSent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessagesSent()
    {
        return $this->messagesSent;
    }

    /**
     * Add messagesReceived
     *
     * @param \Entity\Message $messagesReceived
     * @return User
     */
    public function addMessagesReceived(\Entity\Message $messagesReceived)
    {
        $this->messagesReceived[] = $messagesReceived;

        return $this;
    }

    /**
     * Remove messagesReceived
     *
     * @param \Entity\Message $messagesReceived
     */
    public function removeMessagesReceived(\Entity\Message $messagesReceived)
    {
        $this->messagesReceived->removeElement($messagesReceived);
    }

    /**
     * Get messagesReceived
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessagesReceived()
    {
        return $this->messagesReceived;
    }

    /**
     * Add outgoingCalls
     *
     * @param \Entity\Call $outgoingCalls
     * @return User
     */
    public function addOutgoingCall(\Entity\Call $outgoingCalls)
    {
        $this->outgoingCalls[] = $outgoingCalls;

        return $this;
    }

    /**
     * Remove outgoingCalls
     *
     * @param \Entity\Call $outgoingCalls
     */
    public function removeOutgoingCall(\Entity\Call $outgoingCalls)
    {
        $this->outgoingCalls->removeElement($outgoingCalls);
    }

    /**
     * Get outgoingCalls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutgoingCalls()
    {
        return $this->outgoingCalls;
    }

    /**
     * Add incomingCalls
     *
     * @param \Entity\Call $incomingCalls
     * @return User
     */
    public function addIncomingCall(\Entity\Call $incomingCalls)
    {
        $this->incomingCalls[] = $incomingCalls;

        return $this;
    }

    /**
     * Remove incomingCalls
     *
     * @param \Entity\Call $incomingCalls
     */
    public function removeIncomingCall(\Entity\Call $incomingCalls)
    {
        $this->incomingCalls->removeElement($incomingCalls);
    }

    /**
     * Get incomingCalls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIncomingCalls()
    {
        return $this->incomingCalls;
    }
}
