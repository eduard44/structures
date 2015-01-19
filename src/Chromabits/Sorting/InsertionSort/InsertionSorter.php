<?php

namespace Chromabits\Sorting\InsertionSort;

use Chromabits\Nucleus\Support\ArrayUtils;
use Chromabits\Sorting\Comparators\NumericComparator;
use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Interfaces\SorterInterface;

/**
 * Class InsertionSorter
 *
 * Implementation of the INSERTION-SORT algorithm
 *
 * @package Chromabits\Sorting\InsertionSort
 */
class InsertionSorter implements SorterInterface
{

    /**
     * @var \Chromabits\Nucleus\Support\ArrayUtils
     */
    protected $arrayUtils;

    /**
     * Comparator to use for sorting
     *
     * @var \Chromabits\Sorting\Interfaces\ComparatorInterface
     */
    protected $comparator;

    /**
     * Construct an instance of a InsertionSorter
     *
     * @param \Chromabits\Sorting\Interfaces\ComparatorInterface $comparator
     */
    public function __construct(ComparatorInterface $comparator = null)
    {
        $this->arrayUtils = new ArrayUtils();

        $this->comparator = (is_null($comparator)) ? new NumericComparator() : $comparator;
    }

    /**
     * Sorts an input array and returns the resulting array
     *
     * @param array $input
     *
     * @return array
     */
    public function sort(array $input)
    {
        for ($i = 1; $i < count($input); $i++) {
            $j = $i;

            while ($j > 0 && $this->comparator->compare($input[$j - 1], $input[$j]) > 0) {
                $this->arrayUtils->exchange($input, $j, $j - 1);

                $j--;
            }
        }

        return $input;
    }
}
