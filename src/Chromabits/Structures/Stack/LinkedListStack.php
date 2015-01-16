<?php

namespace Chromabits\Structures\Stack;

use Chromabits\Structures\LinkedList\Interfaces\LinkedListInterface;
use Chromabits\Structures\Stack\Interfaces\StackInterface;

/**
 * Class LinkedListStack
 *
 * A stack implementation using a linked list
 *
 * @package src\Chromabits\Structures\Stack
 */
abstract class LinkedListStack implements StackInterface
{
    /**
     * Internal linked list
     *
     * @var LinkedListInterface
     */
    protected $list;

    /**
     * Construct an instance of a LinkedListStack
     */
    public function __construct()
    {
        $this->initList();
    }

    protected abstract function initList();

    /**
     * Push an element into the top of the stack
     *
     * @param $content
     *
     * @return \Chromabits\Structures\LinkedList\Node
     */
    public function push($content)
    {
        return $this->list->push($content);
    }

    /**
     * Pop the top of the stack
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     */
    public function pop()
    {
        return $this->list->pop();
    }

    /**
     * Get the current element on the top of the stack
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface|null
     */
    public function top()
    {
        return $this->list->tail();
    }
}
