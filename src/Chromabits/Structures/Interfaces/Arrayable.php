<?php

namespace Chromabits\Structures\Interfaces;

/**
 * Interface Arrayable
 *
 * Represents an object which
 *
 * @package Chromabits\Structures\Interfaces
 */
interface Arrayable
{
    /**
     * Get the array representation of this object
     *
     * @return array
     */
    public function toArray();
}
