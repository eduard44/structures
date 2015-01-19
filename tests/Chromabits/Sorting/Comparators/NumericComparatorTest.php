<?php

namespace Tests\Chromabits\Sorting\Comparators;

use Chromabits\Sorting\Comparators\NumericComparator;
use Tests\Chromabits\Support\TestCase;

/**
 * Class NumericComparatorTest
 *
 * @package Tests\Chromabits\Sorting\Comparators
 */
class NumericComparatorTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Comparators\NumericComparator',
                'Chromabits\Sorting\Interfaces\ComparatorInterface'
            ],
            new NumericComparator()
        );
    }

    public function testCompare()
    {
        $comparator = new NumericComparator();

        $this->assertEquals(0, $comparator->compare(10, 10));
        $this->assertEquals(0, $comparator->compare(10.1, 10.1));
        $this->assertEquals(0, $comparator->compare(10, 10.0));

        $this->assertLessThan(0, $comparator->compare(10, 100.10));
        $this->assertGreaterThan(0, $comparator->compare(999, 10.90));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCompareWithInvalid()
    {
        $comparator = new NumericComparator();

        $comparator->compare([], ['lol']);
    }
}
