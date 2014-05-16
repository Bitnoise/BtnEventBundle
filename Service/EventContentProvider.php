<?php

namespace Btn\EventBundle\Service;

use Btn\NodesBundle\Service\NodeContentProviderInterface;
use Btn\EventBundle\Form\NodeContentType;

/**
* EventContentProvider
*
*/
class EventContentProvider implements NodeContentProviderInterface
{

    private $router;
    private $em;

    public function __construct($router, $em)
    {
        $this->router = $router;
        $this->em     = $em;
    }

    public function getForm()
    {
        $events = $this->em->getRepository('BtnEventBundle:Event')->findAll();

        $data = array();
        foreach ($events as $event) {
            $data[$event->getId()] = $event->getTitle();
        }

        return new NodeContentType($data);
    }

    public function resolveRoute($formData = array())
    {

        return 'app_event_show';
    }

    public function resolveRouteParameters($formData = array())
    {
        return array('id' => $formData['event']);
    }

    public function resolveControlRoute($formData = array())
    {

        return 'cp_event_edit';
    }

    public function resolveControlRouteParameters($formData = array())
    {
        return array('id' => $formData['event']);
    }
}