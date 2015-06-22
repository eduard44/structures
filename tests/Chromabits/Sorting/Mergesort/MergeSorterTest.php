<?php

namespace Tests\Chromabits\Sorting\Mergesort;

use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Mergesort\MergeSorter;
use Tests\Chromabits\Sorting\AbstractSorterTest;

/**
 * Class MergeSorterTest
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Tests\Chromabits\Sorting\Mergesort
 */
class MergeSorterTest extends AbstractSorterTest
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                MergeSorter::class,
                'Chromabits\Sorting\Interfaces\SorterInterface'
            ],
            $this->make()
        );
    }

    protected function make(ComparatorInterface $comparator = null)
    {
        return new MergeSorter($comparator);
    }
}
