<?php

namespace Feedme\FeedmeUserBundle\Model\Manager;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

/**
 * Class FeedmeUserRepository
 * @package Feedme\FeedmeUserBundle\Model\Manager
 */
class FeedmeUserRepository extends EntityRepository
{
    /**
     * @param array $criteria
     * @param array $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $criteria = $this->parseCriteria($criteria);
        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        return $persister->loadAll($criteria, $orderBy, $limit, $offset);
    }

    private function parseCriteria($criteria = [], $like = false)
    {
        $criteria = new Criteria();
        foreach ($criteria as $crit => $value) {
            $op = $like ? 'contains' : 'eq';
            $criteria->andWhere($criteria->expr()->{$op}($crit, $value));
        }

        return $criteria;
    }
}
