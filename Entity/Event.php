<?php

namespace Btn\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Btn\EventBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="datetime")
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="datetime")
     */
    private $toDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ticket_url", type="string", length=255, nullable=true)
     */
    private $ticketUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="venue_url", type="string", length=255, nullable=true)
     */
    private $venueUrl;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=255, nullable=true)
     */
    private $venue;
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param  string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set ticketUrl
     *
     * @param  string $ticketUrl
     * @return Event
     */
    public function setTicketUrl($ticketUrl)
    {
        $this->ticketUrl = $ticketUrl;

        return $this;
    }

    /**
     * Get ticketUrl
     *
     * @return string
     */
    public function getTicketUrl()
    {
        return $this->ticketUrl;
    }

    /**
     * Set venueUrl
     *
     * @param  string $venueUrl
     * @return Event
     */
    public function setVenueUrl($venueUrl)
    {
        $this->venueUrl = $venueUrl;

        return $this;
    }

    /**
     * Get venueUrl
     *
     * @return string
     */
    public function getVenueUrl()
    {
        return $this->venueUrl;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set venue
     *
     * @param  string $venue
     * @return Event
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return string
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set fromDate
     *
     * @param  \DateTime $fromDate
     * @return Event
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param  \DateTime $toDate
     * @return Event
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set isActive
     *
     * @param  boolean $isActive
     * @return Event
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
