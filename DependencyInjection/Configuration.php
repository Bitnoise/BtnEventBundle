<?php

namespace Btn\EventBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('btn_event');

        $rootNode
            ->children()
                ->arrayNode('calendar')
                    ->children()
                        ->arrayNode('parameters')
                            ->children()
                                ->scalarNode('resources')->defaultValue('BtnEventBundle:Calendar')->end()
                                ->arrayNode('twig')
                                    ->children()
                                        ->scalarNode('month')->defaultValue('month')->end()
                                        ->scalarNode('week')->defaultValue('week')->end()
                                        ->scalarNode('day')->defaultValue('day')->end()
                                        ->scalarNode('mini')->defaultValue('mini')->end()
                                    ->end()
                                ->end()
                                ->scalarNode('extension')->defaultValue('html.twig')->end()
                                ->arrayNode('dictionary')
                                    ->children()
                                        ->arrayNode('months')
                                            ->children()
                                                ->arrayNode('short')
                                                    ->defaultValue(array('1' => 'Sty.', '2' => 'Lu.', '3' => 'Mar.', '4' => 'Kw.', '5' => 'Maj.', '6' => 'Czerw.', '7' => 'Lip.', '8' => 'Sier.', '9' => 'Wrz.', '10' => 'Paź.', '11' => 'Lis.', '12' => 'Gru.'))
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('short_sms')
                                                    ->defaultValue(array('1' => 'sty', '2' => 'lut', '3' => 'mar', '4' => 'kwie', '5' => 'maj', '6' => 'czer', '7' => 'lip', '8' => 'sier', '9' => 'wrze', '10' => 'paz', '11' => 'list', '12' => 'gru'))
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('extended')
                                                    ->defaultValue(array('1' => 'Styczeń', '2' => 'Luty', '3' => 'Marzec', '4' => 'Kwiecień', '5' => 'Maj', '6' => 'Czerwiec', '7' => 'Lipiec', '8' => 'Sierpień', '9' => 'Wrzesień', '10' => 'Październik', '11' => 'Listopad', '12' => 'Grudzień'))
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('spell')
                                                    ->defaultValue(array('1' => 'stycznia', '2' => 'lutego', '3' => 'marca', '4' => 'kwietnia', '5' => 'maja', '6' => 'czerwca', '7' => 'lipca', '8' => 'sierpnia', '9' => 'września', '10' => 'października', '11' => 'listopada', '12' => 'grudnia'))
                                                    ->prototype('scalar')->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                        ->arrayNode('days')
                                            ->children()
                                                ->arrayNode('short')
                                                    ->defaultValue(array('1' => 'Pn', '2' => 'Wt', '3' => 'Śr', '4' => 'Czw', '5' => 'Pt', '6' => 'Sb', '7' => 'Nd'))
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('extended')
                                                    ->defaultValue(array('1' => 'Poniedziałek', '2' => 'Wtorek', '3' => 'Środa', '4' => 'Czwartek', '5' => 'Piątek', '6' => 'Sobota', '7' => 'Niedziela'))
                                                    ->prototype('scalar')->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                                ->scalarNode('minute_height')->defaultValue('0.7')->end()
                                ->scalarNode('height')->defaultValue('600')->end()
                                ->scalarNode('hour_start')->defaultValue('0')->end()
                                ->scalarNode('hour_end')->defaultValue('22')->end()
                                ->scalarNode('show_week_nb')->defaultValue('true')->end()
                                ->scalarNode('show_days')->defaultValue('days')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
