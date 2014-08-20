<?php

namespace Btn\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Btn\EventBundle\Model\AbstractEvent;

/**
 * @ORM\Table(name="btn_event", indexes={
 *     @ORM\Index(name="created_at_idx", columns={"created_at"}),
 * })
 * @ORM\Entity(repositoryClass="Btn\EventBundle\Repository\EventRepository")
 */
class Event extends AbstractEvent
{
}
