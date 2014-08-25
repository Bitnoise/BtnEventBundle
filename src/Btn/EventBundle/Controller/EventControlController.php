<?php

namespace Btn\EventBundle\Controller;

use Btn\AdminBundle\Controller\CrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Btn\AdminBundle\Annotation\Crud;

/**
 * @Route("/event")
 * @Crud()
 */
class EventControlController extends CrudController
{
}
