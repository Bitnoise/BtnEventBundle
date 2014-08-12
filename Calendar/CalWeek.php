<?php

namespace Btn\EventBundle\Calendar;

class CalWeek extends CalBase
{

    public function __construct(\DateTime $date = null, $hourStart = 0, $hourEnd = 23)
    {
        parent::__construct($date, $hourStart, $hourEnd);

        $this->init();
    }

    public function init()
    {
        $tmpDay = $this->date->format(self::CODE_DAY_OF_MONTH);

        $this->start = clone($this->date);
        $this->start->setTime(0, 0, 0);

        $tmpDay = $this->start->format(self::CODE_DAY_OF_WEEK);

        if ($tmpDay != $this->getFirstDayOfWeek()) {
            $this->start->modify('previous '.$this->getFirstDayOfWeekName());
        }

        $this->end = clone($this->start);
        $this->end->modify('+6 days');
    }
}
