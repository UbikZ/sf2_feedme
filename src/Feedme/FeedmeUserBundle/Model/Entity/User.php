<?php

namespace Feedme\FeedmeUserBundle\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package Feedme\FeedmeUserBundle\Model\Entity
 * @ORM\Entity
 * @ORM\Table(name="user", indexes={})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $society;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $comment;

    /**
     * @ORM\ManyToMany(targetEntity="Feedme\FeedmeUserBundle\Model\Entity\Group")
     * @ORM\JoinTable(
     *      name="user_tl_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     * @var Group
     */
    protected $groups;

    public function __construct()
    {
        parent::__construct();
    }
}
