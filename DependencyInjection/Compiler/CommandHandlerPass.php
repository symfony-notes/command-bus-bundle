<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * This compiler pass maps handler to commands.
 */
class CommandHandlerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('notes.command_bus')) {
            return;
        }

        $commandToHandlerMaps = [];

        foreach ($container->findTaggedServiceIds('command_bus.handler') as $id => $tags) {
            $class = $container->getDefinition($id)->getClass();
            $commandToHandlerMaps[$class::support()] = $id;
        }

        $container->findDefinition('notes.command_bus')->setArguments([
            $container->findDefinition('container'),
            $commandToHandlerMaps,
        ]);
    }
}
