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
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Quicksort\MiddleQuicksortSorter',
                'Chromabits\Sorting\Quicksort\QuicksortSorter',
                'Chromabits\Sorting\Interfaces\SorterInterface'
            ],
            $this->make()
        );
    }

    protected function make(ComparatorInterface $comparator = null)
    {
        return new MiddleQuicksortSorter($comparator);
    }
}
