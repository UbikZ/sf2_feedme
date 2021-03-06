<?php

namespace Feedme\FeedmeUserBundle\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Feedme\AppBundle\Model\Entity\Wall;
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
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $organization;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $comment;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $location;

    /**
     * @ORM\Column(name="location_display", type="boolean")
     * @var bool
     */
    protected $locationDisplay = true;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $website;

    /**
     * @ORM\Column(name="website_display", type="boolean")
     * @var bool
     */
    protected $websiteDisplay = true;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $backgroundImageUrl;

    /**
     * @var array
     */
    protected $gravatarImages;

    /**
     * @ORM\OneToOne(targetEntity="Feedme\AppBundle\Model\Entity\Wall")
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

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getBackgroundImageUrl()
    {
        return $this->backgroundImageUrl;
    }

    /**
     * @param string $backgroundImageUrl
     */
    public function setBackgroundImageUrl($backgroundImageUrl)
    {
        $this->backgroundImageUrl = $backgroundImageUrl;
    }


    /**
     * @return array
     */
    public function getGravatarImages()
    {
        return $this->gravatarImages;
    }

    /**
     * @param array $gravatarImages
     */
    public function setGravatarImages($gravatarImages)
    {
        $this->gravatarImages = $gravatarImages;
    }
}
