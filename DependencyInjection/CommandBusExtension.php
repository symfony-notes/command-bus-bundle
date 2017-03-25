<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
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

    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'notes_command_bus';
    }
}
