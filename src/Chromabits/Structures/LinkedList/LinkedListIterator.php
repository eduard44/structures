<?php

namespace Chromabits\Structures\LinkedList;

use Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException;
use Chromabits\Structures\LinkedList\Interfaces\LinkedListInterface;
use Iterator;

/**
 * Class LinkedListIterator
 *
 * Iterator for LinkedList objects
 *
 * @package Chromabits\Structures\LinkedList
 */
class LinkedListIterator implements Iterator
{

    /**
     * Current position of the iterator
     *
     * @var \Chromabits\Structures\LinkedList\Node
     */
    protected $current;

    /**
     * LinkedList being iterated
     *
     * @var \Chromabits\Structures\LinkedList\Interfaces\LinkedListInterface
     */
    protected $linkedList;

    /**
     * Construct an instance of a LinkedListIterator
     *
     * @param \Chromabits\Structures\LinkedList\Interfaces\LinkedListInterface $linkedList
     */
    public function __construct(LinkedListInterface $linkedList)
    {
        $this->linkedList = $linkedList;

        $this->current = $this->linkedList->tail();

        $this->position = 0;
    }

    /**
     * Reset the iterator
     */
    public function rewind()
    {
        $this->current = $this->linkedList->tail();

        $this->position = 0;
    }

    /**
     * Get the current element
     *
     * @return mixed
     * @throws \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function current()
    {
        if (is_null($this->current)) {
            throw new IndexOutOfBoundsException;
        }

        return $this->current->getContent();
    }

    /**
     * Get the current key
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Get whether or not the current position is valid
     *
     * @return bool
     */
    public function valid()
    {
        return !is_null($this->current);
    }

    /**
     * Move the iterator to the next element
     */
    public function next()
    {
        $this->current = $this->current->getNext();

        $this->position++;
    }
}
