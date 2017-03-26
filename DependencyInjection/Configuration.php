<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $builder->root('notes_command_bus')
            ->children()
                ->arrayNode('default_middlewares')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('handlers_without_default_middlewares')
                    ->prototype('scalar')
                    ->defaultValue([])
                    ->end()
                ->end()
            ->end()
        ;

        return $builder;
    }
}
