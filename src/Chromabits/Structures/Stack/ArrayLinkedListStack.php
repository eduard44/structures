<?php

namespace Chromabits\Structures\Stack;

use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\LinkedList\ArrayLinkedList;
use Chromabits\Structures\Interfaces\Flushable;

/**
 * Class ArrayLinkedListStack
 *
 * A stack data structure implementation using a ArrayLinkedList
 *
 * @package src\Chromabits\Structures\Stack
 */
class ArrayLinkedListStack extends LinkedListStack implements Flushable, Countable
{
    /**
     * @var ArrayLinkedList
     */
    protected $list;

    /**
     * Initialize the internal linked list
     */
    protected function initList()
    {
        $this->list = new ArrayLinkedList();
    }

    /**
     * Get the current number of elements in this instance
     */
    public function count()
    {
        return $this->list->count();
    }

    /**
     * Clear all elements of this instance and restore it
     * to its original state
     *
     * @return mixed
     */
    public function flush()
    {
        return $this->list->flush();
    }

    /**
     * Return whether or not the stack is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return is_null($this->list->head());
    }
}
