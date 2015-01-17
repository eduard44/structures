<?php

namespace Chromabits\Structures\Traits;

use Chromabits\Structures\Exceptions\IndexOutOfBoundsException;

/**
 * Trait ExchangeableElementsTrait
 *
 * @package Chromabits\Structures\Traits
 */
trait ExchangeableElementsTrait
{
    /**
     * Exchange two elements in an array
     *
     * @param array $elements
     * @param int $indexA
     * @param int $indexB
     *
     * @throws \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public static function exchange(array &$elements, $indexA, $indexB)
    {
        $count = count($elements);

        if (($indexA < 0 || $indexA > ($count - 1)) ||
            $indexB < 0 || $indexB > ($count - 1)) {
            throw new IndexOutOfBoundsException;
        }

        $temp = $elements[$indexA];

        $elements[$indexA] = $elements[$indexB];

        $elements[$indexB] = $temp;
    }
}
