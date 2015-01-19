<?php

namespace Tests\Chromabits\Sorting;

use Chromabits\Sorting\Comparators\StringComparator;
use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Tests\Chromabits\Support\TestCase;

/**
 * Class AbstractSorterTest
 *
 * Base class for most sorting tests
 *
 * @package Tests\Chromabits\Sorting
 */
abstract class AbstractSorterTest extends TestCase
{
    public abstract function testConstructor();

    protected abstract function make(ComparatorInterface $comparator = null);

    public function testSort()
    {
        $input = [30, 60, 80, 65, 90, 01, 70];
        $output = [01, 30, 60, 65, 70, 80, 90];

        $sorter = $this->make();

        $this->assertEquals($output, $sorter->sort($input));
    }

    public function testSortWithStrings()
    {
        $input = ['a', 'ee', 's', 'e', 'z'];
        $output = ['a', 'e', 'ee', 's', 'z'];

        $sorter = $this->make(new StringComparator());

        $this->assertEquals($output, $sorter->sort($input));
    }
}
