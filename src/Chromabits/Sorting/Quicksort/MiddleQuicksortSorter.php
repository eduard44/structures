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
    protected function select(array &$input, $head, $tail)
    {
        return floor(($tail + $head)) / 2;
    }
}
