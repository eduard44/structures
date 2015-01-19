<?php

namespace Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Interfaces\HasherInterface;

/**
 * Class NumericHasher
 *
 * A very simple hasher for numeric values
 *
 * @package Chromabits\Structures\Map\Hashers
 */
class NumericHasher implements HasherInterface
{
    /**
     * Return numeric hash of input
     *
     * @param $input
     *
     * @return int|float
     */
    public function hash($input)
    {
        return (float)$input;
    }
}
