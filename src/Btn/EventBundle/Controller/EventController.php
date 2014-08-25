<?php

namespace Btn\EventBundle\Controller;

use Btn\BaseBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class EventController extends BaseController
{
    /**
     * @Route("/show/{id}", name="app_event_show")
     * @Template()
     */
    public function showAction(Request $request, $id)
    {
        $event = $this->getRepository('BtnEventBundle:Event')->findOneBy(array('id' => $id, 'isActive' => 1));

        if (!$event) {

            throw $this->createNotFoundException('The entity does not exist');
        }

        return array('event' => $event);
    }

    /**
     * @Route("/render-calendar", name="render_calendar")
     * @Template()
     */
    public function renderCalendarAction()
    {
        $calendar    = $this->get('btn_event.calendar');
        $sessionDate = $this->get('session')->get('date-calendar');

        if ($this->get('request')->get('date')) {
            $this->get('session')->set('date-calendar', $this->get('request')->get('date'));
        }

        $date    = new \DateTime($this->get('session')->get('date-calendar'), $calendar->getTimezone());
        $minDate = new \DateTime('01-01-2000', $calendar->getTimezone());
        $maxDate = new \DateTime('01-01-2020', $calendar->getTimezone());

        $date = ($date > $maxDate ? $maxDate : $date);
        $date = ($date < $minDate ? $minDate : $date);

        $calendar
            ->setDate(($date ? $date : $minDate))
            ->setEvents(
                $this->getRepository('BtnEventBundle:Event')->getEventsByMonth(
                    $calendar->getMonth()->getStart(),
                    $calendar->getMonth()->getEnd()
                )
            )
        ;

        return $this->render(
            'BtnEventBundle:Event:_calendarBox.html.twig',
            array(
                'calendar' => $calendar,
                'minDate'  => $minDate,
                'maxDate'  => $maxDate,
            )
        );
    }
}
