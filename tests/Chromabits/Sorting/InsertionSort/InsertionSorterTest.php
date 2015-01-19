<?php

namespace Tests\Chromabits\Sorting\InsertionSort;

use Chromabits\Sorting\Comparators\StringComparator;
use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\InsertionSort\InsertionSorter;
use Tests\Chromabits\Support\TestCase;

/**
 * Class InsertionSorterTest
 *
 * @package Tests\Chromabits\Sorting\Quicksort
 */
class InsertionSorterTest extends TestCase
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

    public function testSort()
    {
        $input = [30, 60, 80, 65, 90, 01, 70];
        $output = [01, 30, 60, 65, 70, 80, 90];

        $sorter = $this->make();

        $this->assertEquals($output, $sorter->sort($input));
    }

    public function testSortWithStrings()
    {
        $input = ['a', 'g', 's', 'e', 'z'];
        $output = ['a', 'e', 'g', 's', 'z'];

        $sorter = $this->make(new StringComparator());

        $this->assertEquals($output, $sorter->sort($input));
    }
}

