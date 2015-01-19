<?php

namespace Chromabits\Sorting\Interfaces;

/**
 * Interface ComparatorInterface
 *
 * A class capable of comparing two objects
 *
 * @package Chromabits\Sorting\Interfaces
 */
interface ComparatorInterface
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
    public function compare($one, $two);
}
