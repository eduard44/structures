<?php

namespace Tests\Chromabits\Sorting\Quicksort;

use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Quicksort\RandomizedQuicksortSorter;

/**
 * Class RandomizedQuicksortSorterTest
 *
 * @package Tests\Chromabits\Sorting\Quicksort
 */
class RandomizedQuicksortSorterTest extends QuicksortSorterTest
{
    protected function make(ComparatorInterface $comparator = null)
    {
        return new RandomizedQuicksortSorter($comparator);
    }
}
