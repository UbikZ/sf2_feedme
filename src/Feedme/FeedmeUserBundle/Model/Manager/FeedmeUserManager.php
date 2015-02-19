<?php

namespace Feedme\FeedmeUserBundle\Model\Manager;

use FOS\UserBundle\Doctrine\UserManager;

/**
 * Class FeedmeUserManager
 * @package Feedme\FeedmeUserBundle\Model\Manager
 */
class FeedmeUserManager extends UserManager
{
    /**
     * @param array $criteria
     * @param array $orderBy
     * @param null $limit
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit);
    }
}
