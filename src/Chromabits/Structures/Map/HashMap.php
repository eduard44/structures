<?php

namespace Chromabits\Structures\Map;

use Chromabits\Structures\Exceptions\InvalidOperationException;
use Chromabits\Structures\Interfaces\Arrayable;
use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\Interfaces\Emptyable;
use Chromabits\Structures\LinkedList\ArrayLinkedList;
use Chromabits\Structures\Map\Hashers\ScalarHasher;
use Chromabits\Structures\Map\Interfaces\MapInterface;

/**
 * Class HashMap
 *
 * A simple hashmap implementation
 *
 * @package Chromabits\Structures\Map
 */
class HashMap implements MapInterface, Countable, Emptyable, Arrayable
{
    const INITIAL_SIZE = 10;

    /**
     * Internal hasher
     *
     * @var \Chromabits\Structures\Map\Interfaces\HasherInterface
     */
    protected $hasher;

    /**
     * Internal array of elements
     *
     * @var \Chromabits\Structures\LinkedList\ArrayLinkedList[]
     */
    protected $buckets;

    /**
     * How much should the internal array grow and shrink
     *
     * @var int
     */
    protected $scaleFactor;

    /**
     * Defines the maximum load before the structure expands the
     * internal array
     *
     * @var float
     */
    protected $maxLoad;

    /**
     * Defines the minimum load before the structure shrinks the
     * internal array
     *
     * @var float
     */
    protected $minLoad;

    /**
     * Construct an instance of a HashMap
     */
    public function __construct()
    {
        $this->hasher = new ScalarHasher();

        $this->scaleFactor = 2;
        $this->minLoad = 0.5;
        $this->maxLoad = 1.5;

        $this->buckets = array_fill(0, self::INITIAL_SIZE, null);
    }

    /**
     * Get the value of a key or null if it does not exist
     *
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        $index = $this->computeIndex($key);

        if (is_null($this->buckets[$index])) {
            return null;
        }

        $bucketIndex = $this->existsInBucket($this->buckets[$index], $key);

        if ($bucketIndex === false) {
            return null;
        }

        return $this->buckets[$index]->get($bucketIndex)->getContent()->getContent();
    }

    /**
     * Set the value of a key
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $index = $this->computeIndex($key);

        if (is_null($this->buckets[$index])) {
            $this->buckets[$index] = new ArrayLinkedList();
        }

        $this->addToBucket($this->buckets[$index], $key, $value);
    }

    /**
     * Get whether or not the key has a defined value
     *
     * @param $key
     *
     * @return mixed
     */
    public function has($key)
    {
        return !is_null($this->get($key));
    }

    /**
     * Get the current load factor of the hash map
     *
     * @return float
     */
    protected function getLoadFactor()
    {
        return $this->count() / (float) count($this->buckets);
    }

    /**
     * Grow the internal array
     */
    protected function grow()
    {
        $old = array_merge($this->buckets);

        $this->buckets = array_fill(0, count($old) * $this->scaleFactor, null);

        $this->rehash($old);
    }

    /**
     * Shrink the internal array
     */
    protected function shrink()
    {
        $old = array_merge($this->buckets);

        $this->buckets = array_fill(0, count($old) / $this->scaleFactor, null);

        $this->rehash($old);
    }

    /**
     * Add multiple elements from a buckets array with a different
     * size than the current one by recalculating each elements
     * index and adding them to each bucket accordingly
     *
     * @param array $old
     */
    protected function rehash(array $old)
    {
        foreach ($old as $key => $value)
        {
            $index = $this->computeIndex($value);

            if (is_null($this->buckets[$index])) {
                $this->buckets[$index] = new ArrayLinkedList();
            }

            $this->addToBucket($this->buckets[$index], $key, $value);
        }
    }

    /**
     * Add a key/value pair to a bucket
     *
     * A value is replace on a Node if the key already exists
     * or a new Node is created and added to the list with
     * key and value info
     *
     * @param \Chromabits\Structures\LinkedList\ArrayLinkedList $bucket
     * @param $key
     * @param $value
     */
    protected function addToBucket(ArrayLinkedList $bucket, $key, $value)
    {
        $index = $this->existsInBucket($bucket, $key);

        if ($index !== false) {
            $bucket->get($index)->getContent()->setContent($value);
        } else {
            $node = new Node();

            $node->setKey($key);
            $node->setContent($value);

            $bucket->push($node);
        }
    }

    /**
     * An element is removed from the bucket if its key is defined in any node
     *
     * @param \Chromabits\Structures\LinkedList\ArrayLinkedList $bucket
     * @param $key
     *
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    protected function removeFromBucket(ArrayLinkedList$bucket, $key)
    {
        $index = $this->existsInBucket($bucket, $key);

        if ($index === false) {
            throw new InvalidOperationException('Unable to remove non-existent key-value pair');
        }

        $bucket->remove($index);
    }

    /**
     * Return whether or not a key already exists inside a bucket
     *
     * @param \Chromabits\Structures\LinkedList\ArrayLinkedList $bucket
     * @param $key
     *
     * @return bool|int
     */
    protected function existsInBucket(ArrayLinkedList $bucket, $key)
    {
        $count = 0;
        $current = $bucket->tail();

        while (!is_null($current)) {
            if ($current->getContent()->getKey() == $key) {
                return $count;
            }

            $count++;
            $current = $current->getNext();
        }

        return false;
    }

    /**
     * Hash and compute the index at which a specific key should go
     *
     * @param $key
     *
     * @return int
     */
    protected function computeIndex($key)
    {
        $hash = $this->hasher->hash($key);

        return $hash % count($this->buckets);
    }

    /**
     * Get the current number of elements in this instance
     */
    public function count()
    {
        $count = 0;

        foreach ($this->buckets as $bucket) {
            if (is_null($bucket)) {
                continue;
            }

            $count += $bucket->count();
        }

        return $count;
    }

    /**
     * Remove the value from the map
     *
     * @param $key
     *
     * @return mixed
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function remove($key)
    {
        $index = $this->computeIndex($key);

        if (is_null($this->buckets[$index])) {
            throw new InvalidOperationException('Unable to remove non-existent key-value pair');
        }

        $this->removeFromBucket($this->buckets[$index], $key);
    }

    protected function handleScale()
    {
        // TODO: Check if load-factor indicates we should/grow or shrink

        // TODO: Grow or shrink
    }

    /**
     * Return whether or not the structure should grow it's internal
     * array
     *
     * @return bool
     */
    protected function shouldGrow()
    {
        return ($this->getLoadFactor() > $this->maxLoad);
    }

    /**
     * Return whether or not the structure should shrink it's internal
     * array
     *
     * @return bool
     */
    protected function showShrink()
    {
        return ($this->getLoadFactor() < $this->minLoad);
    }

    /**
     * Get the array representation of this object
     *
     * @return array
     */
    public function toArray()
    {
        $output = [];

        foreach ($this->buckets as $bucket) {
            if (is_null($bucket)) {
                continue;
            }

            /** @var Node[] $bucket */
            foreach ($bucket as $hashMapNode) {
                $output[$hashMapNode->getKey()] = $hashMapNode->getContent();
            }
        }

        return $output;
    }

    /**
     * Returns whether or not the set is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        foreach ($this->buckets as $bucket) {
            if (!is_null($bucket) && $bucket->count() != 0) {
                return false;
            }
        }

        return true;
    }
}
