<?php

namespace Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Interfaces\HasherInterface;

/**
 * Class NaiveStringHasher
 *
 * A very simple string hasher
 *
 * @package Chromabits\Structures\Map\Hashers
 */
class NaiveStringHasher implements HasherInterface
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
        $input = (string)$input;

        $count = 0;

        for ($i = 0; $i < strlen($input); $i++) {
            $count += ord($input[$i]);
        }

        return $count;
    }
}
