<?php

namespace Chromabits\Structures\LinkedList;

use Chromabits\Structures\Interfaces\Flushable;
use Chromabits\Structures\Interfaces\NodeInterface;

/**
 * Class Node
 *
 * Represents a node of a single-linked list
 *
 * @package Chromabits\Structures\LinkedList
 */
class Node implements NodeInterface, Flushable
{
    /**
     * The next node in the linked list
     *
     * @var \Chromabits\Structures\LinkedList\Node|null
     */
    protected $next;

    /**
     * The content of the node
     *
     * @var mixed
     */
    protected $content;

    /**
     * Constructs an instance of a Node
     *
     * @param $content
     * @param \Chromabits\Structures\LinkedList\Node|null $next
     */
    public function __construct($content, $next = null)
    {
        $this->next = $next;

        $this->content = $content;
    }

    /**
     * Get the next node
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Set reference to the next node in the list
     *
     * @param \Chromabits\Structures\LinkedList\Node|null $next
     */
    public function setNext($next = null)
    {
        $this->next = $next;
    }

    /**
     * Get the content of the node
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content of the node
     *
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Restore the node to its original state
     */
    public function flush()
    {
        $this->content = null;

        $this->flushNext();
    }

    /**
     * Reset the next node pointer
     */
    public function flushNext()
    {
        $this->next = null;
    }
}
