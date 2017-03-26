<?php

namespace SymfonyNotes\CommandBusBundle;

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
