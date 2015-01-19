<?php

namespace Chromabits\Sorting\Quicksort;

/**
 * Class RandomizedQuicksortSorter
 *
 * A randomized version of QuickSort
 *
 * @package Chromabits\Sorting\Quicksort
 */
class RandomizedQuicksortSorter extends QuicksortSorter
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
        // Here we just pick a random integer between the start and
        // end of the current partition (inclusive) and use that as
        // the pivot
        return rand($head, $tail);
    }
}
