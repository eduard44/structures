<?php

namespace Chromabits\Structures\Map\Interfaces;

/**
 * Interface HasherInterface
 *
 * Defines an object capable of computing a numeric value
 * for all the instances of another type
 *
 * @package Chromabits\Structures\Map\Interfaces
 */
interface HasherInterface
{
    /**
     * Return numeric hash of input
     *
     * @param $input
     *
     * @return int|float
     */
    public function hash($input);
}
