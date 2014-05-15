<?php

namespace Btn\EventBundle\Controller;

use Btn\BaseBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class EventController extends BaseController
{
    /**
     * @Route("/btn-event-dummy", name="btn_event_dummy")
     * @Template()
     */
    public function dummyAction(Request $request)
    {

    }
}
