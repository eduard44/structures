<?php

namespace Tests\Chromabits\Sorting\Comparators;

use Chromabits\Sorting\Comparators\StringComparator;
use Tests\Chromabits\Support\TestCase;

/**
 * Class StringComparatorTest
 *
 * @package Tests\Chromabits\Sorting\Comparators
 */
class StringComparatorTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Comparators\StringComparator',
                'Chromabits\Sorting\Interfaces\ComparatorInterface'
            ],
            new StringComparator()
        );
    }

    public function testCompare()
    {
        $comparator = new StringComparator();

        $this->assertEquals(0, $comparator->compare('hello', 'hello'));
        $this->assertEquals(0, $comparator->compare('HELLO', 'hello'));

        $this->assertLessThan(0, $comparator->compare('a', 'zzzzz'));
        $this->assertGreaterThan(0, $comparator->compare('zzzzz', 'aa'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCompareWithInvalid()
    {
        $comparator = new StringComparator();

        $comparator->compare([], ['lol']);
    }
}
