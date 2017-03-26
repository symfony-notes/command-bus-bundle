<?php

namespace SymfonyNotes\CommandBusBundle\Middleware;

use SymfonyNotes\CommandBusBundle\Command\CommandInterface;

/**
 * Interface MiddlewareInterface
 */
interface MiddlewareInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return void
     */
    public function __invoke(CommandInterface $command);
}
