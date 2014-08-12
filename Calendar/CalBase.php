<?php

namespace Btn\EventBundle\Calendar;

class CalBase
{
    protected $daynames = array(1 => 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

    protected $monthnames = array(1 =>'january', 'february', 'march', 'april', 'may',
                                 'june', 'july', 'august', 'september', 'october',
                                 'november', 'december');

    /**
	 * our argument day
	 */
    protected $date = null;

    /**
	 * start day calculated on the base of $this->date
	 * fit to full week
	 */
    protected $start = null;

    /**
	 * end day calculated on the base of $this->date
	 * fit to full week
	 */
    protected $end   = null;

    /**
	 * start hour - counts for day traversing
	 */
    protected $hourStart = 0;

    /**
	 * end hour - counts for day traversinf
	 */
    protected $hourEnd = 23;

    /**
	 * array for CalWeek objects
	 */
    protected $weeks = array();

    /**
	 * array for CalDay objects
	 */
    protected $days  = array();

    protected $today = null;

    //by default set first day of Week to monday
    protected $firstDayOfWeek = 1;

    //last day of week is sunday by default
    protected $lastDayOfWeek  = 7;

    //P[n]Y[n]M[n]DT[n]H[n]M[n]S
    //http://en.wikipedia.org/wiki/ISO_8601
    protected $duration = 'PT1H';

    //1 - Monday, 7 - Sunday
    const CODE_DAY_OF_WEEK  = 'N';

    //1 - 28/29/30/31
    const CODE_DAY_OF_MONTH = 'j';

    //1 - 12
    const CODE_MONTH_OF_YEAR = 'n';

    //start from 0 - 365
    const CODE_DAY_OF_YEAR  = 'z';

    const DEFAULT_FIRST_DAY_OF_WEEK = 1;

    protected $timezone;

    public function __construct(\DateTime $date = null, $hourStart = 0, $hourEnd = 23)
    {
        $this->timezone = new \DateTimeZone('Europe/Warsaw');

        $this->date  = $date ? $date : new \DateTime('now', $this->timezone);

        //set time to default
        $this->date->setTime(0, 0, 0);

        $this->setHourStart($hourStart);

        $this->setHourEnd($hourEnd);

    }

    /**
	 * set first day, default is 1 (monday), last day will be set also
	 */
    public function setFirstDayOfWeek($firstDayOfWeek)
    {
        //there has to be some set up
        $this->firstDayOfWeek = $firstDayOfWeek ? $firstDayOfWeek : self::DEFAULT_FIRST_DAY_OF_WEEK;
        $this->lastDayOfWeek  = $firstDayOfWeek == 1 ? 7 : --$firstDayOfWeek;
    }

    public function getFirstDayOfWeek()
    {
        return $this->firstDayOfWeek;
    }

    public function setFitToWeek($value)
    {
        return $this->fitToWeek = $value;
    }

    public function getFitToWeek()
    {
        return $this->fitToWeek;
    }

    public function getLastDayOfWeek()
    {
        return $this->lastDayOfWeek;
    }

    /**
	 * http://www.php.net/manual/pl/datetime.formats.relative.php
	 */
    public function getFirstDayOfWeekName()
    {
        return $this->daynames[$this->getFirstDayOfWeek()];
    }

    public function getLastDayOfWeekName()
    {
        return $this->daynames[$this->getLastDayOfWeek()];
    }

    public function setHourStart($hour)
    {
        $this->hourStart = ($hour >= 0 && $hour < 24
                            && is_numeric($hour)
                            && $this->hourStart < $this->hourEnd) ? $hour : 0;
    }

    public function setHourEnd($hour)
    {
        $this->hourEnd = ($hour >= 0 && $hour < 24
                          && is_numeric($hour)
                          && $this->hourStart < $hour) ? $hour : 23;
    }

    public function getHourStart()
    {
        return $this->hourStart;
    }

    public function getHourEnd()
    {
        return $this->hourEnd;
    }

    /**
	 * @return array of \DateTime objects where every one is set to begin of week in period
	 */
    public function getWeekDates()
    {
        $interval = new \DateInterval('P1W');
        $end   = clone($this->end);

        return  new \DatePeriod($this->start, $interval, $end->modify('+1 day'));
    }

    /**
	 * @return array of CalWeek objects
	 */
    public function getWeeks()
    {
        foreach ($this->getWeekDates() as $week) {
            $this->weeks[] = new CalWeek($week, $this->getHourStart(), $this->getHourEnd());
        }

        return $this->weeks;
    }

    /**
	 * @return array of \DateTime objects where every one is set to beginning of a day
	 */
    public function getDayDates()
    {
        //set interval to one week
        $interval = new \DateInterval('P1D');
        $end      = clone($this->end);

        return new \DatePeriod($this->start, $interval, $end->modify('+1 day'));
    }

    /**
	 * @return arra of CalDay objects,
	 */
    public function getDays()
    {
        $this->days = array();
        foreach ($this->getDayDates() as $day) {
            $this->days[] = new CalDay($day, $this->getHourStart(), $this->getHourEnd());
        }

        return $this->days;
    }

    public function getHours($duration = null)
    {
        if ($duration) {
            $this->setDuration($duration);
        }

        $duration = new \DateInterval($this->duration);

        $end = clone($this->end);

        return  new \DatePeriod($this->start, $duration, $end->modify('+1 hour'));
    }

    public function getDateHours($duration = null)
    {
        if (!$duration) {
            $duration = $this->duration;
        }

        $duration = new \DateInterval($duration);

        $start = clone($this->date);
        $start->setTime($this->getHourStart(), 0, 0);

        $end = clone($this->date);
        $end->setTime($this->getHourEnd(), 0, 0);

        return  new \DatePeriod($start, $duration, $end->modify('+1 hour'));
    }

    public function getDate()
    {
        return $this->start;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setStart(\DateTime $value)
    {
        $this->start = $value;
    }

    public function setEnd(\DateTime $value)
    {
        $this->end = $value;
    }

    public function getNextMonth()
    {
        $obj = clone($this->date);

        return $obj->modify('+1 month');
    }

    public function getNextWeek()
    {
        $obj = clone($this->date);

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
        $obj = clone($this->date);

        return $obj->modify('-1 week');
    }

    public function getPrevDay()
    {
        $obj = clone($this->date);

        return $obj->modify('-1 day');
    }

    public function getIsToday()
    {
        if (!$this->today) {
            $this->today = new \DateTime('now', $this->timezone);
            $this->today->setTime(0, 0, 0);
        }

        return $this->date == $this->today;
    }

    public function getMonthNumber()
    {
        return $this->date->format(self::CODE_MONTH_OF_YEAR);
    }

    public function getDayWeekNumber()
    {
        return $this->date->format(self::CODE_DAY_OF_WEEK);
    }

    public function getDayMonthNumber()
    {
        return $this->date->format(self::CODE_DAY_OF_MONTH);
    }

    public function getDayYearNumber()
    {
        return $this->date->format(self::CODE_DAY_OF_YEAR);
    }

    public function getToday()
    {
        $today = new \DateTime('now', $this->timezone);

        return $today->setTime(0, 0, 0);
    }

    public function setDuration($duration)
    {
        if (!$duration) return false;

        $this->duration = $duration;
    }
}
