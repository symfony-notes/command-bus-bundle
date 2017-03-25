<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle;

use SymfonyNotes\CommandBusBundle\Command\CommandInterface;
use SymfonyNotes\CommandBusBundle\Command\CommandResultInterface;

/**
 * Interface CommandBusInterface
 */
interface CommandBusInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return null|CommandResultInterface
     */
    public function handle(CommandInterface $command);
}
