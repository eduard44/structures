<?php

namespace Tests\Chromabits\Sorting\Comparators;

use Chromabits\Sorting\Comparators\StringCaseComparator;
use Tests\Chromabits\Support\TestCase;

/**
 * Class StringCaseComparatorTest
 *
 * @package Tests\Chromabits\Sorting\Comparators
 */
class StringCaseComparatorTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Sorting\Comparators\StringCaseComparator',
                'Chromabits\Sorting\Interfaces\ComparatorInterface'
            ],
            new StringCaseComparator()
        );
    }

    public function testCompare()
    {
        $comparator = new StringCaseComparator();

        $this->assertEquals(0, $comparator->compare('hello', 'hello'));
        $this->assertNotEquals(0, $comparator->compare('HELLO', 'hello'));

        $this->assertLessThan(0, $comparator->compare('a', 'zzzzz'));
        $this->assertLessThan(0, $comparator->compare('A', 'a'));
        $this->assertGreaterThan(0, $comparator->compare('zzzzz', 'aa'));
        $this->assertGreaterThan(0, $comparator->compare('aa', 'aA'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCompareWithInvalid()
    {
        $comparator = new StringCaseComparator();

        $comparator->compare([], ['lol']);
    }
}
