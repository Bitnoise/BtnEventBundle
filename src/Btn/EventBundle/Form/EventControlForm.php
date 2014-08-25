<?php

namespace Btn\EventBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Btn\AdminBundle\Form\AbstractForm;

class EventControlForm extends AbstractForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('title', null, array(
                'label' => 'btn_event.event.title'
                ))
            ->add('fromDate', 'btn_datetime', array(
                'label' => 'btn_event.event.from_date'
                ))
            ->add('toDate', 'btn_datetime', array(
                'label' => 'btn_event.event.to_date'
                ))
            ->add('description', null, array(
                'label' => 'btn_event.event.description'
                ))
            ->add('isActive', null, array(
                'label' => 'btn_event.event.active'))
            ->add('save', $options['data']->getId() ? 'btn_save' : 'btn_create')
        ;
    }

    public function getName()
    {
        return 'btn_event_form_event_control';
    }
}
