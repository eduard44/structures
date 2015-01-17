<?php

namespace Chromabits\Structures\Heap;

use Chromabits\Structures\Exceptions\InvalidOperationException;
use Chromabits\Structures\Heap\ArrayHeap;

/**
 * Class MinArrayHeap
 *
 * A min-heap implementation using arrays
 *
 * @package Chromabits\Structures\Heap
 */
class MinArrayHeap extends ArrayHeap
{
    public function insert($element)
    {
        $heapSize = count($this->elements);

        $this->elements[$heapSize] = null;

        self::decrease($this->elements, $heapSize, $element);
    }

    /**
     * The HEAP-DECREASE-KEY algorithm
     *
     * @param array $elements
     * @param int $target Index of the target element
     * @param int $element Value to replace the target with
     *
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public static function decrease(array &$elements, $target, $element)
    {
        if (!is_null($elements[$target]) && $element > $elements[$target]) {
            throw new InvalidOperationException;
        }

        $elements[$target] = $element;

        while ($target > 0 && $elements[self::getParentIndex($target)] > $elements[$target]) {
            self::exchange($elements, $target, self::getParentIndex($target));

            $target = self::getParentIndex($target);
        }
    }

    /**
     * Build the a min-heap out of an array
     *
     * @param array $input
     */
    public function heapify(array $elements)
    {
        $heapSize = count($elements);

        for ($i = self::getParentIndex($heapSize - 1); $i > 0; $i--) {
            self::minHeapify($elements, $i);
        }

        $this->elements = $elements;
    }

    /**
     * The MIN-HEAPIFY algorithm
     *
     * @param array $elements
     * @param int $index
     *
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public static function minHeapify(array &$elements, $index = 0)
    {
        $left = self::getLeftIndex($index);
        $right = self::getRightIndex($index);

        $heapSize = count($elements);
        $smallest = $index;

        if ($left < $heapSize && $elements[$left] < $elements[$index]) {
            $smallest = $left;
        }

        if ($right < $heapSize && $elements[$right] < $elements[$smallest]) {
            $smallest = $right;
        }

        if ($smallest != $index) {
            self::exchange($elements, $index, $smallest);
            self::minHeapify($elements, $smallest);
        }
    }
}
