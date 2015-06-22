<?php

namespace Chromabits\Sorting\Mergesort;

use Chromabits\Sorting\Comparators\NumericComparator;
use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Interfaces\SorterInterface;

/**
 * Class MergeSorter
 *
 * Sorts arrays using the mergesort algorithm.
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Sorting\Mergesort
 */
class MergeSorter implements SorterInterface
{
    /**
     * Construct an instance of a MergeSorter.
     *
     * @param ComparatorInterface|null $comparator
     */
    public function __construct(ComparatorInterface $comparator = null)
    {
        if ($comparator === null) {
            $this->comparator = new NumericComparator();
        } else {
            $this->comparator = $comparator;
        }
    }

    /**
     * Sort the provided array.
     *
     * @param array $input
     *
     * @return array
     */
    public function sort(array $input) {
        $length = count($input);

        if ($length == 1) {
            return $input;
        }

        $middle = $length / 2.0;
        $left = [];
        $right = [];

        for ($ii = 0; $ii < $length; $ii++) {
            if ($ii < $middle) {
                $left[] = $input[$ii];
                continue;
            }

            $right[] = $input[$ii];
        }

        $left = $this->sort($left);
        $right = $this->sort($right);

        return $this->merge($left, $right);
    }

    /**
     * Merge two sorted arrays.
     *
     * @param $left
     * @param $right
     *
     * @return array
     */
    public function merge($left, $right) {
        $result = [];
        $lcount = count($left);
        $rcount = count($right);
        $ii = 0;
        $jj = 0;

        for (; $ii < $lcount && $jj < $rcount;) {
            $lcurrent = $left[$ii];
            $rcurrent = $right[$jj];

            if ($this->comparator->compare($lcurrent, $rcurrent) > 0) {
                $result[] = $rcurrent;
                $jj++;

                continue;
            }

            $result[] = $lcurrent;
            $ii++;
        }

        while ($ii < $lcount) {
            $result[] = $left[$ii];
            $ii++;
        }

        while ($jj < $rcount) {
            $result[] = $right[$jj];
            $jj++;
        }

        return $result;
    }
}
