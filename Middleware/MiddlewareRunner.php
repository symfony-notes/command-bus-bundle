<?php

namespace SymfonyNotes\CommandBusBundle;

use SymfonyNotes\CommandBusBundle\Command\CommandInterface;

/**
 * Class MiddlewareRunner
 */
class MiddlewareRunner
{
    /**
     * @var MiddlewareInterface[]
     */
    private $middlewares;

    /**
     * @param MiddlewareInterface[] $middlewares
     */
    public function __construct(array $middlewares = [])
    {
        foreach ($middlewares as $middleware) {
            if (!$middleware instanceof MiddlewareInterface) {
                throw new \RuntimeException('Command bus middleware must implements "MiddlewareInterface"');
            }
        }

        $this->middlewares = $middlewares;
    }

    /**
     * Run chine of middlewares.
     *
     * @param CommandInterface $command
     */
    public function run(CommandInterface $command)
    {
        foreach ($this->middlewares as $middleware) {
            $middleware($command);
        }
    }
}
