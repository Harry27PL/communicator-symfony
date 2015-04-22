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

}