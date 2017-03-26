<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class CommandBusExtension
 */
class CommandBusExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $container->setParameter('notes_command_bus_default_middlewares', $mergedConfig['default_middlewares']);
        $container->setParameter('notes_command_bus_default_handlers_without_default_middlewares', $mergedConfig['handlers_without_default_middlewares']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'notes_command_bus';
    }
}
