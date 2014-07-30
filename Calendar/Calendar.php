<?php

namespace Btn\EventBundle\Calendar;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Btn\EventBundle\Util\Text;

class Calendar
{
    protected $router;
    protected $twig;
    protected $parameters;
    protected $resources = 'BtnEventBundle:Calendar';
    protected $date;
    protected $tpl = null;

    protected $month = null;
    protected $week  = null;
    protected $day   = null;
    protected $tplExtension = null;

    protected $customParameters = array();

    protected $minuteHeight = null;

    protected $events = null;

    protected $eventResources = null;

    protected $timezone;

	public function __construct( UrlGeneratorInterface $router, \Twig_Environment $twig, $parameters)
    {
        $this->router = $router;
        $this->twig   = $twig;

        $this->parameters = $parameters;

        $this->hourStart = $parameters['hour_start'];
        $this->hourEnd   = $parameters['hour_end'];

        $this->timezone = new \DateTimeZone('Europe/Warsaw');

        $this->date = new \DateTime('now', $this->timezone);
    }

    public function setResources($resources)
    {
        $this->resources = $resources;
        return $this;
    }

    public function setEventResources($resources)
    {
        $this->eventResources = $resources;
        return $this;
    }

    public function getEventResources()
    {
        return $this->eventResources ? $this->eventResources : $this->resources;
    }

    public function getTpl()
    {
    	return $this->tpl;
    }

    public function setTpl($tpl)
    {
        $this->tpl = $tpl;
        return $this;
    }

    protected function buildTpl($tpl)
    {
        if (!$this->getTpl() && isset($this->parameters['twig'][$tpl])) {
            $tpl = $this->parameters['twig'][$tpl];
        }

        return $this->resources.':'.$tpl.'.'.$this->getTplExtension();
    }

    public function getTplExtension()
    {
        if (!$this->tplExtension) return $this->parameters['extension'];

        return $this->tplExtension;
    }

    public function setTplExtension($ext)
    {
        $this->tplExtension = $ext;
        return $this;
    }

    public function getMonth()
    {
        if (!$this->month) {
            $this->month = new CalMonth($this->getDate(), $this->hourStart, $this->hourEnd);
        }

    	return $this->month;
    }

    public function getWeek()
    {
        if (!$this->week) {
            $this->week = new CalWeek($this->getDate(), $this->hourStart, $this->hourEnd);
        }
    	return $this->week;
    }

    public function getDay()
    {
        if (!$this->day) {
            $this->day = new CalDay($this->getDate(), $this->hourStart, $this->hourEnd);
        }

    	return $this->day;
    }

    public function clean()
    {
        $this->month = null;
        $this->week  = null;
        $this->day   = null;
    }

    public function render($tpl = 'week')
    {
    	return $this->twig
    				->render($this->buildTpl($tpl),
    					array(
    							'calendar'       => $this,
    							'parameters'     => $this->parameters,
                                'customParameters' => $this->getCustomParameters(),
                                'events'         => $this->events,
                                'eventResources' => $this->getEventResources(),
                                'resources'      => $this->resources
    						)
    					);
    }

    public function setDate($date)
    {
        if (is_numeric($date)) {
            $this->date = date_create('@'.$date, $this->timezone);
            $this->date->setTimezone($this->timezone);
        } elseif ($date instanceof \DateTime) {
            $this->date = $date;
        } else {
            $this->date = date_create($date, $this->timezone);
        }

        if (!$this->date) $this->date = new \DateTime('now', $this->timezone);

        $this->clean();

    	return $this;
    }

    public function getDate()
    {
    	return $this->date;
    }

    public function setHourStart($hour)
    {
    	$this->hourStart = $hour;
    	return $this;
    }

    public function setHourEnd($hour)
    {
    	$this->hourEnd = $hour;
    	return $this;
    }

    public function getHourStart()
    {
    	return $this->hourStart;
    }

    public function getHourEnd()
    {
    	return $this->hourEnd();
    }

    public function getParameters()
    {
    	return $this->parameters;
    }

    public function getParameter($key)
    {
    	return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    public function setParameter($key, $value)
    {
    	$this->parameters[$key] = $value;
    	return $this;
    }

    public function mergeParameters(array $parameters)
    {
    	$this->parameters = array_merge($this->parameters, $parameters);
    	return $this;
    }

    public function __toString()
    {
    	return $this->render();
    }

    public function modify($string)
    {
        $this->date->modify($string);
        $this->clean();
        return $this;
    }

    public function cloneModify($string)
    {
        $date = clone($this->date);
        return $date->modify($string);
    }

    public function getNextMonth()
    {
        $obj = clone($this->date);
        return $obj->modify('+1 month');
    }

    public function getNextWeek()
    {
        $obj = clone($this->getWeek()->getStart());
        return $obj->modify('+1 week');
    }

    public function getNextDay()
    {
        $obj = clone($this->date);
        return $obj->modify('+1 day');
    }

    public function getPrevMonth()
    {
        $obj = clone($this->date);
        return $obj->modify('-1 month');
    }

    public function getPrevWeek()
    {
        $obj = clone($this->getWeek()->getStart());
        return $obj->modify('-1 week');
    }

    public function getPrevDay()
    {
        $obj = clone($this->date);
        return $obj->modify('-1 day');
    }

    public function getMonthName($type = 'extended', $monthNb = false)
    {
        $nb = $monthNb ? $monthNb : $this->getDay()->getMonthNumber();
        return $this->parameters['dictionary']['months'][$type][$nb];
    }

    public function getDayName($type = 'extended', $dayWeekNb = false)
    {
        $nb = $dayWeekNb ? $dayWeekNb : $this->getDay()->getDayWeekNumber();
        return $this->parameters['dictionary']['days'][$type][$nb];
    }

    public function getFullName()
    {
        $name = $this->getDay()->getDayMonthNumber();
        $name .= ' '.$this->getMonthName('spell').' '.$this->getDate()->format('Y');
        $name .= ' ('.strtolower($this->getDayName()).')';

        return $name;
    }

    public function getFullNameSms()
    {
        $name = $this->getDay()->getDayMonthNumber();
        $name .= ' '.$this->getMonthName('short_sms').' '.$this->getDate()->format('Y');
        $name .= ' '.Text::slugify($this->getDayName());

        return $name;
    }

    public function getToday()
    {
        $today = new \DateTime('now', $this->timezone);
        return $today->setTime(0, 0, 0);
    }

    public function getCustomParameters()
    {
        return $this->customParameters;
    }

    public function setCustomParameters($customParameters)
    {
        $this->customParameters = $customParameters;
        return $this;
    }

    public function getCustomParameter($key)
    {
        return isset($this->customParameters[$key]) ? $this->customParameters[$key] : null;
    }

    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }

    public function getEvents()
    {
        return $this->events;
    }

    //few day formaters
    public function getWithTextMonth($date = null)
    {
        $day = (!empty($date) && $date instanceof \DateTime) ? new CalDay($date) : $this->getDay();
        return $day->getDate()->format('j').' '.$this->getMonthName('spell', $day->getDate()->format('n')).', '.$day->getDate()->format('Y');
    }

    public function getTimezone()
    {
        return $this->timezone;
    }
}
