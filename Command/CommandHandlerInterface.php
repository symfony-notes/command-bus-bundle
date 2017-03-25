<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\Command;

/**
 * Interface CommandHandlerInterface
 */
interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return null|CommandResultInterface
     */
    public function handle(CommandInterface $command);

    /**
     * Return array of supported classes name CommandInterface::class.
     *
     * @return string
     */
    public static function support(): string;
}
