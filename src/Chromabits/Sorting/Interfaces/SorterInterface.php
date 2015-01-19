<?php

namespace Chromabits\Sorting\Interfaces;

/**
 * Interface SorterInterface
 *
 * Defines a common interfaces for classes capable of
 * sorting arrays of data
 *
 * @package Chromabits\Sorting\Interfaces
 */
interface SorterInterface
{
    /**
     * Sorts an input array and returns the resulting array
     *
     * @param array $input
     *
     * @return array
     */
    public function sort(array $input);
}
