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
        return rand($head, $tail);
    }
}
