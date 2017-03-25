<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\Exception;

/**
 * Class MissingHandlerException
 */
class MissingHandlerException extends \RuntimeException
{
    /**
     * @param string $command
     */
    public function __construct(string $command)
    {
        parent::__construct(sprintf('Missing handler for command "%s".', $command));
    }
}
