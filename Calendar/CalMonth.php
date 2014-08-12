<?php

namespace Btn\EventBundle\Calendar;

class CalMonth extends CalBase
{

    public function __construct(\DateTime $date = null, $hourStart = 0, $hourEnd = 23)
    {
        parent::__construct($date, $hourStart, $hourEnd);

        $this->init();
    }

    public function init()
    {
        //start of the month
        $this->start = clone($this->date);
        $this->start->modify('first day of this month')->setTime(0, 0, 0);

        //end of the month
        $this->end   = clone($this->date);
        $this->end->modify('last day of this month')->setTime(0, 0, 0);

        $this->fitToWeek();
    }

    /**
	* fit start & end to the week display settings
	* default $this->firstDayOfWeek is 1 (monday)
	*/
    private function fitToWeek()
    {
        if ($this->start->format(self::CODE_DAY_OF_WEEK) != $this->getFirstDayOfWeek()) {
            $this->start->modify('previous '.$this->getFirstDayOfWeekName());
        }

        if ($this->end->format(self::CODE_DAY_OF_WEEK) != $this->getLastDayOfWeek()) {
            $this->end->modify('next '.$this->getLastDayOfWeekName());
        }
    }
}
