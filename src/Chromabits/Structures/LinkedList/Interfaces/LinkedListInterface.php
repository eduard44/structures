<?php

namespace Chromabits\Structures\LinkedList\Interfaces;

/**
 * Interface LinkedListInterface
 *
 * Represents methods that should be defined by an implementation
 * of a linked list data structure
 *
 * @package Chromabits\Structures\LinkedList
 */
interface LinkedListInterface
{
    /**
     * Add an element to the list
     *
     * @param $content
     *
     * @return \Chromabits\Structures\LinkedList\Node
     */
    public function push($content);

    /**
     * Count the number of elements in the list
     *
     * @return int
     */
    public function count();

    /**
     * Get a node in the linked list
     *
     * @param $index
     *
     * @return \Chromabits\Structures\LinkedList\Node
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function get($index);

    /**
     * Remove an element from the end of the list
     *
     * @return \Chromabits\Structures\LinkedList\Node|null
     */
    public function pop();

    /**
     * Get the first element of the list
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface|null
     */
    public function head();

    /**
     * Get the last element of the list
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface|null
     */
    public function tail();
}
