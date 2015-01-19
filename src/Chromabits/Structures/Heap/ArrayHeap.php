<?php

namespace Chromabits\Structures\Heap;

use Chromabits\Structures\BinaryTree\Traits\BinaryNodesTrait;
use Chromabits\Structures\Exceptions\IndexOutOfBoundsException;
use Chromabits\Structures\Heap\Interfaces\HeapInterface;
use Chromabits\Structures\Interfaces\Arrayable;
use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\Interfaces\Emptyable;
use Chromabits\Structures\Interfaces\Flushable;
use Chromabits\Structures\Traits\ExchangeableElementsTrait;

/**
 * Class ArrayHeap
 *
 * A heap data structure implementation using arrays
 *
 * @package src\Chromabits\Structures\Heap
 */
abstract class ArrayHeap implements HeapInterface, Countable, Flushable, Emptyable, Arrayable
{
    use BinaryNodesTrait;
    use ExchangeableElementsTrait;

    /**
     * Internal array of elements
     *
     * @var array
     */
    protected $elements;

    /**
     * Construct an instance of an ArrayHeap
     */
    public function __construct()
    {
        $this->elements = [];
    }

    /**
     * Insert an element into the heap
     *
     * @param $element
     *
     * @return mixed
     */
    public abstract function insert($element);

    /**
     * Fill the heap with an input array
     *
     * The array will be converted to a heap using the MAX-HEAPIFY
     * or MIN-HEAPIFY accordingly
     *
     * @param array $input
     *
     * @return void
     */
    public abstract function heapify(array $input);

    /**
     * Count all elements in the list
     *
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * Remove all elements from the heap and restore it to
     * its original state
     */
    public function flush()
    {
        $this->elements = [];
    }

    /**
     * Get whether or not the heap is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return (count($this->elements) < 1);
    }

    /**
     * Get the element at the top of the heap
     *
     * @return mixed|null
     */
    public function top()
    {
        if ($this->count() == 0) {
            return null;
        }

        return $this->elements[0];
    }

    /**
     * Get a specific element in the heap
     *
     * @param $index
     *
     * @return mixed
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function get($index)
    {
        if ($index < 0 || $index > ($this->count() - 1)) {
            throw new IndexOutOfBoundsException;
        }

        return $this->elements[$index];
    }

    /**
     * Get a specific element in the heap or return null
     *
     * @param $index
     *
     * @return null
     */
    public function getOrNull($index)
    {
        if ($index < 0 || $index > ($this->count() - 1)) {
            return null;
        }

        return $this->elements[$index];
    }

    /**
     * Get the current heap as an array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }
}
