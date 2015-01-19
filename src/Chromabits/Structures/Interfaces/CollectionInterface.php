<?php

namespace Chromabits\Structures\Interfaces;

use IteratorAggregate;

/**
 * Interface CollectionInterface
 *
 * Represents a collection of records
 *
 * @package Chromabits\Structures\Interfaces
 */
interface CollectionInterface extends Arrayable, Countable, Emptyable, Flushable, IteratorAggregate
{
    /**
     * Add an element into to collection
     *
     * @param $record
     *
     * @return mixed
     */
    public function push($record);

    /**
     * Return whether or not the collection contains the specified record
     *
     * @param $record
     *
     * @return bool
     */
    public function has($record);

    /**
     * Remove a specific record from the collection
     *
     * @param $record
     *
     * @return mixed
     */
    public function remove($record);
}
