<?php

namespace Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Interfaces\HasherInterface;
use Chromabits\Structures\Exceptions\InvalidOperationException;

/**
 * Class ScalarHasher
 *
 * A hasher for PHP scalar types (int, float, string, array)
 *
 * @package Chromabits\Structures\Map\Hashers
 */
class ScalarHasher implements HasherInterface
{
    /**
     * @var \Chromabits\Structures\Map\Hashers\NaiveStringHasher
     */
    protected $stringHasher;

    /**
     * @var \Chromabits\Structures\Map\Hashers\NumericHasher
     */
    protected $numericHasher;

    /**
     * @var \Chromabits\Structures\Map\Hashers\ArrayHasher
     */
    protected $arrayHasher;

    /**
     * Construct an instance of a ScalarHasher
     */
    public function __construct()
    {
        $this->stringHasher = new NaiveStringHasher();

        $this->numericHasher = new NumericHasher();

        $this->arrayHasher = new ArrayHasher();
    }

    /**
     * Return numeric hash of input
     *
     * @param $input
     *
     * @return float|int
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function hash($input)
    {
        if (is_string($input)) {
            return $this->stringHasher->hash($input);
        } elseif (is_numeric($input)) {
            return $this->numericHasher->hash($input);
        } elseif (is_array($input)) {
            return $this->arrayHasher->hash($input);
        }

        throw new InvalidOperationException;
    }
}
