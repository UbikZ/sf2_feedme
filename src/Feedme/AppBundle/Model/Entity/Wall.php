<?php

namespace Feedme\AppBundle\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Wall
 * @package Feedme\AppBundle\Model\Entity
 * @ORM\Entity
 * @ORM\Table(name="wall", indexes={})
 */
class Wall
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="wall")
     * @var ArrayCollection
     */
    protected $messages;

    public function __construct()
    {
        $this->setMessages(new ArrayCollection());
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param ArrayCollection $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }
}
