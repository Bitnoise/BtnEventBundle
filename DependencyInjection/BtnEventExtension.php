<?php

namespace Btn\EventBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Btn\BaseBundle\DependencyInjection\AbstractExtension;

class BtnEventExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        parent::load($configs, $container);

        $config = $this->getProcessedConfig($container, $configs);
        $container->setParameter('btn_event.calendar', $config);
        $container->setParameter('btn_event.event.class', $config['event']['class']);
    }
}
