<?php

namespace Chromabits\Structures\Heap;

use Chromabits\Structures\Exceptions\InvalidOperationException;

/**
 * Class MaxArrayHeap
 *
 * A max-heap implementation using arrays
 *
 * @package Chromabits\Structures\Heap
 */
class MaxArrayHeap extends ArrayHeap
{
    /**
     * Insert an element into the heap
     *
     * @param $element
     *
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function insert($element)
    {
        $heapSize = count($this->elements);

        $this->elements[$heapSize] = null;

        self::increase($this->elements, $heapSize, $element);
    }

    /**
     * The HEAP-INCREASE-KEY algorithm
     *
     * @param array $elements
     * @param int $target Index of the target element
     * @param int $element Value to replace the target with
     *
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public static function increase(array &$elements, $target, $element)
    {
        if (!is_null($elements[$target]) && $element < $elements[$target]) {
            throw new InvalidOperationException;
        }

        $elements[$target] = $element;

        while ($target > 0 && $elements[self::getParentIndex($target)] < $elements[$target]) {
            self::exchange($elements, $target, self::getParentIndex($target));

            $target = self::getParentIndex($target);
        }
    }

    /**
     * Build the a min-heap out of an array
     *
     * @param array $elements
     */
    public function heapify(array $elements)
    {
        $heapSize = count($elements);

        for ($i = self::getParentIndex($heapSize - 1); $i >= 0; $i--) {
            self::maxHeapify($elements, $i);
        }

        $this->elements = $elements;
    }

    /**
     * The MAX-HEAPIFY algorithm
     *
     * @param array $elements
     * @param int $index
     *
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public static function maxHeapify(array &$elements, $index = 0)
    {
        $left = self::getLeftIndex($index);
        $right = self::getRightIndex($index);

        $heapSize = count($elements);
        $largest = $index;

        if ($left < $heapSize && $elements[$left] > $elements[$index]) {
            $largest = $left;
        }

        if ($right < $heapSize && $elements[$right] > $elements[$largest]) {
            $largest = $right;
        }

        if ($largest != $index) {
            self::exchange($elements, $index, $largest);
            self::maxHeapify($elements, $largest);
        }
    }
}

