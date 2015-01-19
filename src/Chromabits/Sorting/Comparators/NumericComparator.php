<?php

namespace Chromabits\Sorting\Comparators;

use Chromabits\Sorting\Interfaces\ComparatorInterface;
use InvalidArgumentException;

/**
 * Class NumericComparator
 *
 * A comparator for numeric types
 *
 * @package Chromabits\Sorting\Comparators
 */
class NumericComparator implements ComparatorInterface
{
    /**
     * Compares two objects
     *
     * Returns 0 if both objects are equal
     * Returns a negative number if the second object is larger than the first one
     * Returns a positive number if the first object is larger than the second one
     *
     * @param int|float|double $one
     * @param int|float|double $two
     *
     * @return mixed
     */
    public function compare($one, $two)
    {
        if (!is_numeric($one) || !is_numeric($two)) {
            throw new InvalidArgumentException('NumericComparator only supports numeric types');
        }

        return $one - $two;
    }
}
