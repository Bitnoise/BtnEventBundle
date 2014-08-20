<?php

namespace Btn\EventBundle\Provider;

use Btn\NodeBundle\Provider\NodeContentProviderInterface;
use Btn\EventBundle\Form\NodeContentType;
use Btn\BaseBundle\Provider\EntityProviderInterface;

/**
 *
 */
class NodeContentProvider implements NodeContentProviderInterface
{

    /** $var \Btn\BaseBundle\Provider\EntityProviderInterface $provider */
    private $provider;

    /**
     *
     */
    public function __construct(EntityProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getForm()
    {
        $events = $this->provider->getRepository()->findAll();

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

    /**
     *
     */
    public function resolveControlRoute($formData = array())
    {
        return 'btn_event_eventcontrol_index';
    }

    public function resolveControlRouteParameters($formData = array())
    {
        return array('id' => $formData['event']);
    }

    /**
     *
     */
    public function getName()
    {
        return 'btn_event.node_content_provider.name';
    }
}
