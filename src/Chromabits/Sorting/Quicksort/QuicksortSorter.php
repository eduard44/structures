<?php

namespace Chromabits\Sorting\Quicksort;

use Chromabits\Nucleus\Support\ArrayUtils;
use Chromabits\Sorting\Comparators\NumericComparator;
use Chromabits\Sorting\Interfaces\ComparatorInterface;
use Chromabits\Sorting\Interfaces\SorterInterface;

/**
 * Class QuicksortSorter
 *
 * A simple quicksort implementation
 *
 * @package Chromabits\Sorting\Quicksort
 */
class QuicksortSorter implements SorterInterface
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
     * Construct an instance of a QuicksortSorter
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
        $this->quicksort($input, 0, count($input) - 1);

        return $input;
    }

    /**
     * The PARTITION algorithm
     *
     * @param array $input
     * @param $head
     * @param $tail
     *
     * @return mixed
     * @throws \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    protected function partition(array &$input, $head, $tail)
    {
        // This is not the randomized version, so we will just take the
        // last element in the array as out pivot
        $pivotIndex = $tail;
        $pivotValue = $input[$pivotIndex];

        $this->arrayUtils->exchange($input, $pivotIndex, $tail);

        $storeIndex = $head;

        for ($i = $head; $i < $tail; $i++) {
            $comparison = $this->comparator->compare($input[$i], $pivotValue);

            if ($comparison < 0) {
                $this->arrayUtils->exchange($input, $i, $storeIndex);

                $storeIndex++;
            }
        }

        $this->arrayUtils->exchange($input, $storeIndex, $tail);

        return $storeIndex;
    }

    /**
     * The QUICKSORT algorithm
     *
     * @param array $input
     * @param $head
     * @param $tail
     */
    protected function quicksort(array &$input, $head, $tail)
    {
        if ($head < $tail) {
            $pivot = $this->partition($input, $head, $tail);

            $this->quicksort($input, $head, $pivot - 1);
            $this->quicksort($input, $pivot + 1, $tail);
        }
    }
}
