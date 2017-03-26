<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\Exception;

use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;

/**
 * Class ParamConverterInvalidArgumentException
 */
class ParamConverterInvalidArgumentException extends \InvalidArgumentException
{
    /**
     * @param ParamConverterInterface $paramConverter
     */
    public function __construct(ParamConverterInterface $paramConverter)
    {
        parent::__construct(sprintf('Param converter "%s" require "key" option', get_class($paramConverter)));
    }
}
