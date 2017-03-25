<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use SymfonyNotes\CommandBusBundle\DependencyInjection\CommandBusExtension;
use SymfonyNotes\CommandBusBundle\DependencyInjection\Compiler\CommandHandlerPass;

/**
 * Class SymfonyNotesCommandBusBundle
 */
class SymfonyNotesCommandBusBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new CommandBusExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new CommandHandlerPass());
    }
}
