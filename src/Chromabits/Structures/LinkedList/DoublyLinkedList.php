<?php

namespace Chromabits\Structures\LinkedList;

use Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException;

/**
 * Class DoublyLinkedList
 *
 * @package Chromabits\Structures\LinkedList
 */
class DoublyLinkedList extends LinkedList
{
    /**
     * @var \Chromabits\Structures\LinkedList\DoubleNode|null
     */
    protected $head;

    /**
     * @var \Chromabits\Structures\LinkedList\DoubleNode|null
     */
    protected $tail;

    /**
     * Add an element to the tail of the list
     *
     * @param $content
     *
     * @return \Chromabits\Structures\LinkedList\Node
     */
    public function push($content)
    {
        $node = new DoubleNode($content);

        // If both the head and tail are null, the list is empty
        if (is_null($this->head) && is_null($this->tail)) {
            $this->head = $node;
            $this->tail = $node;
        } else {
            $node->setNext($this->tail);

            if (!is_null($this->tail)) {
                $this->tail->setPrevious($node);
            }

            $this->tail = $node;
        }

        return $node;
    }

    /**
     * Remove an element from the end of the list
     *
     * @return \Chromabits\Structures\LinkedList\DoubleNode|null
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

        if (!is_null($this->tail)) {
            $this->tail->flushPrevious();
        }

        return $last;
    }

    /**
     * Remove an element from the linked list
     *
     * @param int $index
     *
     * @return \Chromabits\Structures\LinkedList\DoubleNode|null
     * @throws \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
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
        // then we will update it so that it points to the
        // element after the current one
        if (!is_null($previous)) {
            $previous->setNext($current->getNext());

            if (!is_null($current->getNext())) {
                $current->getNext()->setPrevious($previous);
            }
        }

        // If the current element was the tail of the list,
        // then we update the tail of the list to the next
        // element
        if ($this->tail == $current) {
            $this->tail = $current->getNext();

            if (!is_null($this->tail)) {
                $this->tail->flushPrevious();
            }
        }

        // If the current element is the head of the list,
        // then we update the head of the list to the previous
        // element
        if ($this->head == $current) {
            $this->head = $previous;

            if (!is_null($this->head)) {
                $this->head->flushNext();
            }
        }

        return $current;
    }
}
