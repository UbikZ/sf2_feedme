<?php

namespace Feedme\AppBundle\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package Feedme\AppBundle\Model\Entity
 * @ORM\Entity
 * @ORM\Table(name="message", indexes={})
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Wall", inversedBy="messages")
     * @ORM\JoinColumn(name="wall_id", referencedColumnName="id")
     **/
    protected $wall;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="parent")
     **/
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Message", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    protected $parent;

    public function __construct()
    {
        $this->setChildren(new ArrayCollection());
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
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
     * @return mixed
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * @param mixed $wall
     */
    public function setWall($wall)
    {
        $this->wall = $wall;
    }
}
