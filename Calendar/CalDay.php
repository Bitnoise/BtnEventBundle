<?php

namespace Btn\EventBundle\Calendar;

use Btn\EventBundle\Calendar\CalBase;

class CalDay extends CalBase
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
 		$this->start->setTime($this->getHourStart(), 0, 0);

		$this->end = clone($this->date);
		$this->end->setTime($this->getHourEnd(), 0, 0);
	}
}
