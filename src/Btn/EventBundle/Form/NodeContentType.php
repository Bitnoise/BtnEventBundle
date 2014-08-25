<?php

namespace Btn\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NodeContentType extends AbstractType
{
    private $data;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('event', 'choice', array('choices' => $this->data))
        ;
    }

    public function getName()
    {
        return 'btn_eventbundle_nodecontent';
    }
}
