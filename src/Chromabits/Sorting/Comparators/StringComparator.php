<?php

namespace Chromabits\Sorting\Comparators;

use Chromabits\Sorting\Interfaces\ComparatorInterface;
use InvalidArgumentException;

/**
 * Class StringComparator
 *
 * A comparator capable of comparing strings ignoring their case
 *
 * @package Chromabits\Sorting\Comparators
 */
class StringComparator implements ComparatorInterface
{
    /**
     * Compares two objects
     *
     * Returns 0 if both objects are equal
     * Returns a negative number if the second object is larger than the first one
     * Returns a positive number if the first object is larger than the second one
     *
     * @param $one
     * @param $two
     *
     * @return mixed
     */
    public function compare($one, $two)
    {
        if (!is_string($one) || !is_string($two)) {
            throw new InvalidArgumentException('StringComparator only supports string types');
        }

        return strcasecmp($one, $two);
    }
}
