<?php

namespace Tests\Chromabits\Sorting\Quicksort;

use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Quicksort\MiddleQuicksortSorter;

/**
 * Class MiddleQuicksortSorterTest
 *
 * @package Tests\Chromabits\Sorting\Quicksort
 */
class MiddleQuicksortSorterTest extends QuicksortSorterTest
{
    protected function make(ComparatorInterface $comparator = null)
    {
        return new MiddleQuicksortSorter($comparator);
    }
}
