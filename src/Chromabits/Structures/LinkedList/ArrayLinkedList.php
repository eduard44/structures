<?php

namespace Chromabits\Structures\LinkedList;

use Chromabits\Structures\Exceptions\IndexOutOfBoundsException;
use Chromabits\Structures\Interfaces\Arrayable;
use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\Interfaces\Emptyable;
use Chromabits\Structures\Interfaces\Flushable;
use Chromabits\Structures\LinkedList\Interfaces\LinkedListInterface;
use IteratorAggregate;
use Traversable;

/**
 * Class ArrayLinkedList
 *
 * A single-linked list implementation
 *
 * @package Chromabits\Structures\LinkedList
 */
class ArrayLinkedList implements LinkedListInterface, Flushable, Countable, Emptyable, IteratorAggregate, Arrayable
{
    /**
     * @var \Chromabits\Structures\LinkedList\Node[]
     */
    protected $nodes;

    /**
     * @var \Chromabits\Structures\LinkedList\Node|null
     */
    protected $head;

    /**
     * @var \Chromabits\Structures\LinkedList\Node|null
     */
    protected $tail;

    /**
     * Construct an instance of a ArrayLinkedList
     */
    public function __construct()
    {
        $this->nodes = [];

        $this->head = null;
        $this->tail = null;
    }

    /**
     * Add an element to an ArrayLinkedList
     *
     * @param $content
     *
     * @return \Chromabits\Structures\LinkedList\Node
     */
    public function push($content)
    {
        $node = new Node($content);

        $this->nodes[] = $node;

        // If both the head and tail are null, the list is empty
        if (is_null($this->head) && is_null($this->tail)) {
            $this->head = $node;
            $this->tail = $node;
        } else {
            $node->setNext($this->tail);

            $this->tail = $node;
        }

        return $node;
    }

    /**
     * Count the number of element in the list
     *
     * @return int
     */
    public function count()
    {
        if (is_null($this->tail)) {
            return false;
        }

        $count = 1;
        $current = $this->tail;

        while (!is_null($current = $current->getNext())) {
            $count++;
        }

        return $count;
    }

    /**
     * Get a node in the linked-list
     *
     * @param $index
     *
     * @return \Chromabits\Structures\LinkedList\Node
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function get($index)
    {
        if (is_null($this->head)) {
            throw new IndexOutOfBoundsException;
        }

        $count = 0;
        $current = $this->head;
        $next  = $current->getNext();

        while (!is_null($next) || $count < 1) {
            if ($count == $index) {
                return $current;
            }

            $count++;
            $current = $next;
        }

        throw new IndexOutOfBoundsException;
    }

    /**
     * Remove an element from the end of the list
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     */
    public function pop()
    {
        if (is_null($this->head) || is_null($this->tail)) {
            return null;
        }

        $last = $this->tail;

        // If this element is both the head and tail, then it is
        // the only element
        if ($last == $this->tail && $last == $this->head) {
            $this->tail = null;
            $this->head = null;
        }

        $this->tail = $last->getNext();

        $this->internalRemove($last);

        return $last;
    }

    /**
     * Removes an element from the internal array
     *
     * @param $node
     */
    protected function internalRemove($node)
    {
        // Remove the element from the internal array
        if(($key = array_search($node, $this->nodes)) !== false) {
            unset($this->nodes[$key]);
        }
    }

    /**
     * Removes all the data from the list
     */
    public function flush()
    {
        $this->head = null;
        $this->tail = null;

        $this->nodes = [];
    }

    /**
     * Returns whether or not the list is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return (is_null($this->tail) && is_null($this->head));
    }

    /**
     * Get the current head of the list
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     */
    public function head()
    {
        return $this->head;
    }

    /**
     * Get the current tail of the list
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     */
    public function tail()
    {
        return $this->tail;
    }

    /**
     * Retrieve an external iterator
     *
     * @return \Chromabits\Structures\LinkedList\LinkedListIterator
     */
    public function getIterator()
    {
        return new LinkedListIterator($this);
    }

    /**
     * Remove an element from the linked list
     *
     * @param int $index
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function remove($index)
    {
        $previous = null;
        $current = $this->tail;
        $currentIndex = 0;

        while ($currentIndex != $index) {
            $previous = $current;
            $current = $current->getNext();

            // If the current pointer is null, the we
            // stepped outside the list, which most likely
            // means the index is outside of the bounds
            if (is_null($current)) {
                throw new IndexOutOfBoundsException;
            }

            $currentIndex++;
        }

        // If the current pointer is null, then the list
        // itself is empty
        if (is_null($current)) {
            throw new IndexOutOfBoundsException;
        }

        // If we have a reference to the previous element,
        // the we will update it so that it points to the
        // element after the current one
        if (!is_null($previous)) {
            $previous->setNext($current->getNext());
        }

        // If the current element was the tail of the list,
        // then we update the tail of the list to the next
        // element
        if ($this->tail == $current) {
            $this->tail = $current->getNext();
        }

        // If the current element is the head of the list,
        // then we update the head of the list to the previous
        // element
        if ($this->head == $current) {
            $this->head = $previous;
        }

        return $current;
    }

    /**
     * Get array version of this instance
     *
     * @return array
     */
    public function toArray()
    {
        $output = [];

        foreach ($this as $node) {
            $output[] = $node;
        }

        return $output;
    }
}
