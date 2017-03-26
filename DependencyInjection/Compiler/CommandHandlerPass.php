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
        $middlewareToHandlerMaps = [];
        $defaultMiddlewares = $this->getDefaultMiddelwares($container);

        foreach ($container->findTaggedServiceIds('command_bus.handler') as $id => $tags) {
            $class = $container->getDefinition($id)->getClass();
            $commandToHandlerMaps[$class::support()] = $id;

            $middlewares = [];

            if (!in_array($id, $container->getParameter('notes_command_bus_default_handlers_without_default_middlewares'))) {
                $middlewares += $defaultMiddlewares;
            }

            $middlewareToHandlerMaps[$id] = $middlewares;
        }

        $container->findDefinition('notes.command_bus')->addArgument($commandToHandlerMaps);
        $container->findDefinition('notes.command_bus')->addArgument($middlewareToHandlerMaps);
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return array
     */
    private function getDefaultMiddelwares(ContainerBuilder $container)
    {
        $result = [];

        foreach ($container->getParameter('notes_command_bus_default_middlewares') as $item) {
            $result[] = $container->getDefinition($item);
        }

        return $result;
    }
}
