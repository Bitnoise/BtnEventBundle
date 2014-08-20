<?php

namespace Btn\EventBundle\Form\Type;

use Btn\AdminBundle\Form\Type\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EventCategoryType extends AbstractType
{
    /**
     *
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'empty_value'   => 'btn_event.type.event.empty_value',
            'label'         => 'btn_event.type.event.label',
            'data_class'    => null,
            'class'         => $this->class,
            'query_builder' => function (EntityRepository $em) {
                return $em
                    ->createQueryBuilder('e')
                    ->orderBy('e.title', 'ASC');
            },
            'property' => 'title',
            'required' => false,
            'expanded' => false,
            'multiple' => false,
        ));
    }

    /**
     *
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     *
     */
    public function getName()
    {
        return 'btn_event';
    }
}
