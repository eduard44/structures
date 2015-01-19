<?php

namespace Tests\Chromabits\Sorting\InsertionSort;

use Chromabits\Sorting\InsertionSort\InsertionSorter;
use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Tests\Chromabits\Sorting\AbstractSorterTest;

/**
 * Class InsertionSorterTest
 *
 * @package Tests\Chromabits\Sorting\Quicksort
 */
class InsertionSorterTest extends AbstractSorterTest
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\InsertionSort\InsertionSorter',
                'Chromabits\Sorting\Interfaces\SorterInterface'
            ],
            $this->make()
        );
    }

    protected function make(ComparatorInterface $comparator = null)
    {
        return new InsertionSorter($comparator);
    }
}

