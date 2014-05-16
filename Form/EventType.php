<?php

namespace Btn\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'btn.event.title'))
            ->add('fromDate', null, array('label' => 'btn.event.from_date'))
            ->add('toDate', null, array('label' => 'btn.event.to_date'))
            ->add('ticketUrl', null, array('label' => 'btn.event.ticket_url'))
            ->add('venueUrl', null, array('label' => 'btn.event.venue_url'))
            ->add('description', null, array('label' => 'btn.event.description'))
            ->add('venue', null, array('label' => 'btn.event.venue'))
            ->add('isActive', null, array('label' => 'btn.event.active'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Btn\EventBundle\Entity\Event'
        ));
    }

    public function getName()
    {
        return 'btn_eventbundle_event';
    }
}
