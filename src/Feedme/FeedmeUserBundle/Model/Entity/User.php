<?php

namespace Feedme\FeedmeUserBundle\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Feedme\WallBundle\Model\Entity\Wall;
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
    protected $organization;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $comment;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $location;

    /**
     * @ORM\Column(name="location_display", type="boolean")
     * @var bool
     */
    protected $locationDisplay = true;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $website;

    /**
     * @ORM\Column(name="website_display", type="boolean")
     * @var bool
     */
    protected $websiteDisplay = true;

    /**
     * @ORM\OneToOne(targetEntity="Feedme\WallBundle\Model\Entity\Wall")
     * @ORM\JoinColumn(name="wall_id", referencedColumnName="id")
     * @var Wall
     */
    protected $wall;

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return boolean
     */
    public function isLocationDisplay()
    {
        return $this->locationDisplay;
    }

    /**
     * @param boolean $locationDisplay
     */
    public function setLocationDisplay($locationDisplay)
    {
        $this->locationDisplay = $locationDisplay;
    }

    /**
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param string $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return Wall
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * @param Wall $wall
     */
    public function setWall($wall)
    {
        $this->wall = $wall;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return boolean
     */
    public function isWebsiteDisplay()
    {
        return $this->websiteDisplay;
    }

    /**
     * @param boolean $websiteDisplay
     */
    public function setWebsiteDisplay($websiteDisplay)
    {
        $this->websiteDisplay = $websiteDisplay;
    }
}
