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
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Quicksort\RandomizedQuicksortSorter',
                'Chromabits\Sorting\Quicksort\QuicksortSorter',
                'Chromabits\Sorting\Interfaces\SorterInterface'
            ],
            $this->make()
        );
    }

    protected function make(ComparatorInterface $comparator = null)
    {
        return new RandomizedQuicksortSorter($comparator);
    }
}
