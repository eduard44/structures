<?php

namespace Chromabits\Sorting\Quicksort;

/**
 * Class MiddleQuicksortSorter
 *
 * QuickSort implementation that uses the middle element in
 * an array as the pivot
 *
 * @package Chromabits\Sorting\Quicksort
 */
class MiddleQuicksortSorter extends QuicksortSorter
{
    /**
     * Select the pivot for the PARTITION step
     *
     * @param array $input
     * @param $head
     * @param $tail
     *
     * @return mixed
     */
    protected function select(array &$input, $head, $tail)
    {
        // Here we try to select the middle of the array as the pivot,
        // however, in cases where the array has an even number of
        // element, we have to settle for one of the two elements
        // in the center
        return floor(($tail + $head)) / 2;
    }
}
