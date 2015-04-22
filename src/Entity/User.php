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
    protected $removedAt = false;

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
        return $this->id*27;
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
        return !$this->removedAt();
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
        return !$this->getUnpaid();
    }

}