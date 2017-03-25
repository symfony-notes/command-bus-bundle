<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\Command;

/**
 * Class ResultCollection
 */
class ResultCollection extends \ArrayIterator implements CommandResultInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException
     */
    public function offsetUnset($index)
    {
        throw new \RuntimeException('Can not delete a value from the result.');
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException
     */
    public function append($value)
    {
        throw new \RuntimeException('Can not append the result.');
    }

    /**
     * @param \Closure $closure
     *
     * @return \CallbackFilterIterator
     */
    public function filter(\Closure $closure)
    {
        return new \CallbackFilterIterator($this, $closure);
    }

    /**
     * @param int      $offset
     * @param int|null $length
     *
     * @return \LimitIterator
     */
    public function slice(int $offset, int $length = null)
    {
        return new \LimitIterator($this, $offset, $length);
    }
}
