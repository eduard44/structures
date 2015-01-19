<?php

namespace Tests\Chromabits\Sorting\Quicksort;

use Chromabits\Sorting\Comparators\StringComparator;
use Chromabits\Sorting\Quicksort\QuicksortSorter;
use Tests\Chromabits\Support\TestCase;

/**
 * Class QuicksortSorterTest
 *
 * @package Tests\Chromabits\Sorting\Quicksort
 */
class QuicksortSorterTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Quicksort\QuicksortSorter',
                'Chromabits\Sorting\Interfaces\SorterInterface'
            ],
            new QuicksortSorter()
        );
    }

    public function testSort()
    {
        $input = [30, 60, 80, 65, 90, 01, 70];
        $output = [01, 30, 60, 65, 70, 80, 90];

        $sorter = new QuicksortSorter();

        $this->assertEquals($output, $sorter->sort($input));
    }

    public function testSortWithStrings()
    {
        $input = ['a', 'ee', 's', 'e', 'z'];
        $output = ['a', 'e', 'ee', 's', 'z'];

        $sorter = new QuicksortSorter(new StringComparator());

        $this->assertEquals($output, $sorter->sort($input));
    }
}
