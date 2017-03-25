<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle;

use SymfonyNotes\CommandBusBundle\Command\CommandInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SymfonyNotes\CommandBusBundle\Command\CommandHandlerInterface;
use SymfonyNotes\CommandBusBundle\Exception\MissingHandlerException;

/**
 * Class CommandBus
 */
class CommandBus implements CommandBusInterface
{
    /**
     * @var array
     */
    private $commandToHandlerMaps;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     * @param array $commandToHandlerMaps
     */
    public function __construct(ContainerInterface $container, array $commandToHandlerMaps)
    {
        $this->container = $container;
        $this->commandToHandlerMaps = $commandToHandlerMaps;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(CommandInterface $command)
    {
        $class = get_class($command);

        if (!array_key_exists($class, $this->commandToHandlerMaps)) {
            throw new MissingHandlerException($class);
        }

        /** @var CommandHandlerInterface $handler */
        $handler = $this->container->get($this->commandToHandlerMaps[$class]);

        return $handler->handle($command);
    }
}