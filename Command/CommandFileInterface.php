<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface CommandFileInterface
 */
interface CommandFileInterface extends CommandInterface
{
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     *
     * @return CommandFileInterface|self
     */
    public function setFile(UploadedFile $file): self;

    /**
     * Gets file.
     *
     * @return UploadedFile
     */
    public function getFile();
}