<?php

namespace Btn\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Btn\EventBundle\Entity\Event;

class EventRepository extends EntityRepository
{
    public function getEventsByMonth(\DateTime $dateFrom, \DateTime $dateTo)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->select()
            ->where('e.isActive = 1')
            ->andWhere($qb->expr()->orX(
                $qb->expr()->gte('e.fromDate', ':dateFrom'),
                $qb->expr()->lte('e.toDate', ':dateTo')
            ))
            ->setParameter('dateFrom', $dateFrom)
            ->setParameter('dateTo', $dateTo->modify('+1 day'))
        ;

        //prepare indexed array
        $indexedEvents = array();
        foreach ($qb->getQuery()->getResult() as $event) {
            $indexedEvents[$event->getFromDate()->format('z')] = $event;
            if ($event->getToDate()) {
                //create days period and iterate on it
                $interval = new \DateInterval("P1D");
                $period   = new \DatePeriod($event->getFromDate(), $interval, $event->getToDate());
                foreach($period as $date){
                    $indexedEvents[$date->format('z')] = $event;
                }
            }
        }

        return $indexedEvents;
    }
}
