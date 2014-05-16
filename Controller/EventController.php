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
}
