<?php

namespace Chromabits\Structures\Interfaces;

/**
 * Interface Flushable
 *
 * Represents a data structure which can be completely cleared
 * and restored to its original state using a flush method
 *
 * @package Chromabits\Structures\Interfaces
 */
interface Flushable
{
    /**
     * Clear all elements of this instance and restore it
     * to its original state
     *
     * @return mixed
     */
    public function flush();
}
