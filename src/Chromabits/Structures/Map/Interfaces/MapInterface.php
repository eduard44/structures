<?php

namespace Chromabits\Structures\Map\Interfaces;

/**
 * Interface MapInterface
 *
 * Represents methods that should be defined by an implementation
 * of a map data structure
 *
 * @package Chromabits\Structures\Map
 */
interface MapInterface
{
    /**
     * Get the value of a key or null if it does not exist
     *
     * @param $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Set the value of a key
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value);

    /**
     * Get whether or not the key has a defined value
     *
     * @param $key
     *
     * @return mixed
     */
    public function has($key);

    /**
     * Remove the value from the map
     *
     * @param $key
     *
     * @return mixed
     */
    public function remove($key);
}
