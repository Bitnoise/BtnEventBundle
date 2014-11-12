<?php

namespace Btn\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Btn\EventBundle\Entity\Event;

class EventRepository extends EntityRepository
{
    public function getEventsByMonth(\DateTime $dateFrom, \DateTime $dateTo)
    {
        // ldd($dateFrom->format('Y-m-d'), $dateTo->format('Y-m-d'));
        $qb = $this->createQueryBuilder('e');
        $qb->select()
            ->where('e.isActive = 1')
            ->andWhere('e.fromDate > :dateFrom')
            ->andWhere('e.toDate < :dateTo')
            ->setParameter('dateFrom', $dateFrom->format('Y-m-d'))
            ->setParameter('dateTo', $dateTo->modify('+1 day')->format('Y-m-d'))
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
