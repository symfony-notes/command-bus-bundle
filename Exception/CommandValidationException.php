<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class CommandValidationException
 */
class CommandValidationException extends \RuntimeException
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violationList;

    /**
     * @param ConstraintViolationListInterface $violationList
     * @param string                           $message
     */
    public function __construct(ConstraintViolationListInterface $violationList, $message = 'Validation failed.')
    {
        parent::__construct($message);

        $this->violationList = $violationList;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors(): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $error */
        foreach ($this->violationList as $error) {
            $errors[$error->getPropertyPath()][] = $error->getMessage();
        }

        return $errors;
    }
}
