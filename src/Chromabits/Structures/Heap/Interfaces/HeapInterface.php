<?php

namespace Chromabits\Structures\Heap\Interfaces;

/**
 * Interface HeapInterface
 *
 * Represents methods that should be defined by an implementation
 * of a heap data structure
 *
 * @package Chromabits\Structures\Heap
 */
interface HeapInterface
{
    /**
     * Insert an element into the heap
     *
     * @param $element
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface|mixed
     */
    public function insert($element);

    /**
     * Build a heap from an array
     *
     * @param array $input
     *
     * @return \Chromabits\Structures\Heap\Interfaces\HeapInterface|mixed
     */
    public function heapify(array $input);

    /**
     * Get the element at the top of the heap
     *
     * @return mixed|null
     */
    public function top();

    /**
     * Get a specific element in the heap
     *
     * @param $index
     *
     * @return mixed
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function get($index);
}
