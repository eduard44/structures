<?php

namespace Chromabits\Structures\LinkedList;

/**
 * Class DoubleNode
 *
 * A linked list node with an additional pointer
 *
 * @package Chromabits\Structures\LinkedList
 */
class DoubleNode extends Node
{
    /**
     * The previous node in the linked list
     *
     * @var \Chromabits\Structures\LinkedList\DoubleNode|null
     */
    protected $previous;

    /**
     * Construct an instance of a DoubleNode
     *
     * @param $content
     * @param \Chromabits\Structures\LinkedList\DoubleNode|null $next
     * @param \Chromabits\Structures\LinkedList\DoubleNode|null $previous
     */
    public function __construct($content, $next = null, $previous = null)
    {
        parent::__construct($content, $next);

        $this->previous = $previous;
    }

    /**
     * Get the previous node in the list
     *
     * @return \Chromabits\Structures\LinkedList\DoubleNode|null
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * Set the previous node in the list
     *
     * @param \Chromabits\Structures\LinkedList\DoubleNode|null $previous
     */
    public function setPrevious($previous)
    {
        $this->previous = $previous;
    }

    /**
     * Restore the node to its original state
     */
    public function flush()
    {
        $this->content = null;

        $this->flushNext();
        $this->flushPrevious();
    }

    /**
     * Reset the previous node pointer
     */
    public function flushPrevious()
    {
        $this->previous = null;
    }
}
