<?php

namespace Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Interfaces\HasherInterface;

/**
 * Class ArrayHasher
 *
 * A hasher for array objects
 *
 * @package Chromabits\Structures\Map\Hashers
 */
class ArrayHasher implements HasherInterface
{
    /**
     * @var \Chromabits\Structures\Map\Hashers\NaiveStringHasher
     */
    protected $stringHasher;

    /**
     * Construct an instance of an ArrayHasher
     */
    public function __construct()
    {
        $this->stringHasher = new NaiveStringHasher();
    }

    /**
     * Return numeric hash of input
     *
     * @param $input
     *
     * @return int|float
     */
    public function hash($input)
    {
        $count = count($input);

        foreach ($input as $key => $value) {
            $count += $this->stringHasher->hash($key);
        }

        return $count;
    }
}
