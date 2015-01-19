<?php

namespace Tests\Chromabits\Sorting\Quicksort;

use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Quicksort\QuicksortSorter;
use Tests\Chromabits\Sorting\AbstractSorterTest;

/**
 * Class QuicksortSorterTest
 *
 * @package Tests\Chromabits\Sorting\Quicksort
 */
class QuicksortSorterTest extends AbstractSorterTest
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Quicksort\QuicksortSorter',
                'Chromabits\Sorting\Interfaces\SorterInterface'
            ],
            $this->make()
        );
    }

    protected function make(ComparatorInterface $comparator = null)
    {
        return new QuicksortSorter($comparator);
    }
}
