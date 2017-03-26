<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\ParamConverter;

use Symfony\Component\HttpFoundation\Request;
use SymfonyNotes\CommandBusBundle\Command\CommandInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use SymfonyNotes\CommandBusBundle\Command\CommandFileInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SymfonyNotes\CommandBusBundle\Exception\CommandValidationException;
use SymfonyNotes\CommandBusBundle\ParamConverter\Factory\CommandFactory;
use SymfonyNotes\CommandBusBundle\Exception\ParamConverterInvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;

class FileCommandParamConverter implements ParamConverterInterface
{
    /**
     * @var CommandFactory
     */
    private $commandFactory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param CommandFactory     $commandFactory
     * @param ValidatorInterface $validator
     */
    public function __construct(CommandFactory $commandFactory, ValidatorInterface $validator)
    {
        $this->commandFactory = $commandFactory;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     *
     * @throws CommandValidationException
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        if (!isset($configuration->getOptions()['key'])) {
            throw new ParamConverterInvalidArgumentException($this);
        }
        /** @var CommandFileInterface $command */
        $command = $this->commandFactory->createFromRequest($request, $configuration->getClass());
        $command->setFile($request->files->get($configuration->getOptions()['key']));

        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            throw new CommandValidationException($errors);
        }

        $request->attributes->set($configuration->getName(), $command);
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        return in_array(CommandInterface::class, class_implements($configuration->getClass()));
    }
}
