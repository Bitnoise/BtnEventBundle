<?php

namespace Btn\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Btn\EventBundle\Entity\Event;

class EventRepository extends EntityRepository
{
    public function getEventsByMonth($dateFrom, $dateTo)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT e FROM Btn\EventBundle\Entity\Event e WHERE e.fromDate > :dateFrom AND e.toDate < :dateTo')
            ->setParameter('dateFrom', $dateFrom)
            ->setParameter('dateTo', $dateTo)
        ;

        $arr = array();

        foreach ($query->getResult() as $entity) {
            $arr[$entity->getDate()->format('z')] = $entity;
        }//foreach

        return $arr;
    }
}
