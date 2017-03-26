<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle;

use SymfonyNotes\CommandBusBundle\Command\CommandInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SymfonyNotes\CommandBusBundle\Middleware\MiddlewareRunner;
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
     * @var array
     */
    private $middlewareToHandlerMaps;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     * @param array              $commandToHandlerMaps
     * @param array              $middlewareToHandlerMaps
     */
    public function __construct(
        ContainerInterface $container,
        array $commandToHandlerMaps = [],
        array $middlewareToHandlerMaps = []
    ) {
        $this->container = $container;
        $this->commandToHandlerMaps = $commandToHandlerMaps;
        $this->middlewareToHandlerMaps = $middlewareToHandlerMaps;
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

        $handlerId = $this->commandToHandlerMaps[$class];
        /** @var CommandHandlerInterface $handler */
        $handler = $this->container->get($handlerId);

        if (array_key_exists($handlerId, $this->middlewareToHandlerMaps)) {
            $middlewareRunner = new MiddlewareRunner($this->middlewareToHandlerMaps[$handlerId]);
            $middlewareRunner->run($command);
        }

        return $handler->handle($command);
    }
}
