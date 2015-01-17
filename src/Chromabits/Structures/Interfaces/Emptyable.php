<?php

namespace Chromabits\Structures\Interfaces;

/**
 * Interface Emptyable
 *
 * Represents an object which can be empty
 *
 * @package Chromabits\Structures\Interfaces
 */
interface Emptyable
{
    /**
     * Returns whether or not the set is empty
     *
     * @return bool
     */
    public function isEmpty();
}
