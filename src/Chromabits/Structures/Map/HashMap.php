<?php

namespace Chromabits\Structures\Map;

use Chromabits\Structures\Exceptions\InvalidOperationException;
use Chromabits\Structures\Interfaces\Arrayable;
use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\Interfaces\Emptyable;
use Chromabits\Structures\LinkedList\LinkedList;
use Chromabits\Structures\Map\Hashers\ScalarHasher;
use Chromabits\Structures\Map\Interfaces\MapInterface;

/**
 * Class HashMap
 *
 * A simple hash map implementation
 *
 * Internally it uses an array and linked list to handle collisions,
 * and scales dynamically to prevent a large number of collisions.
 * How many collisions occur depends largely on the hashing function.
 *
 * Some pre-set properties are:
 *
 * - The internal array will shrink once the load factor goes under
 * the value of 0.5 ($this->minLoad)
 * - The internal array will grow once the load factor goes over
 * the value of 1.5 ($this->maxLoad)
 * - The internal array will not be shrunk to sizes under INITIAL_SIZE
 * - The internal array will be initialized with a size of INITIAL_SIZE
 * - During shrinking and growing operations, the internal array will be
 * scaled by a factor of 2 ($this->scaleFactor)
 * - A Chromabits\Structures\Map\Hashers\ScalarHasher will be used as
 * the hashing function
 *
 * All this properties are customizable by extending this class and
 * overriding the respective properties.
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
     * @var \Chromabits\Structures\LinkedList\LinkedList[]
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
            $this->buckets[$index] = new LinkedList();
        }

        $this->addToBucket($this->buckets[$index], $key, $value);

        $this->resizeIfNeeded();
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
        return $this->count() / (float)count($this->buckets);
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
        // We will cycle over each bucket before the internal array was
        // resize, go throw each element in the bucket, and internally
        // re-add them into the map
        foreach ($old as $oldBucket) {
            // If the old bucket is null, the we can skip it completely
            if (is_null($oldBucket)) {
                continue;
            }

            /** @var Node[] $oldBucket */
            foreach ($oldBucket as $hashMapNode) {
                $index = $this->computeIndex($hashMapNode->getKey());

                // Create a new bucket if it does not exist yet for this
                // index
                if (is_null($this->buckets[$index])) {
                    $this->buckets[$index] = new LinkedList();
                }

                $this->addToBucket($this->buckets[$index], $hashMapNode->getKey(), $hashMapNode->getContent());
            }
        }
    }

    /**
     * Add a key/value pair to a bucket
     *
     * A value is replace on a Node if the key already exists
     * or a new Node is created and added to the list with
     * key and value info
     *
     * @param \Chromabits\Structures\LinkedList\LinkedList $bucket
     * @param $key
     * @param $value
     */
    protected function addToBucket(LinkedList $bucket, $key, $value)
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
     * @param \Chromabits\Structures\LinkedList\LinkedList $bucket
     * @param $key
     *
     * @throws \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    protected function removeFromBucket(LinkedList $bucket, $key)
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
     * @param \Chromabits\Structures\LinkedList\LinkedList $bucket
     * @param $key
     *
     * @return bool|int
     */
    protected function existsInBucket(LinkedList $bucket, $key)
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

        $this->resizeIfNeeded();
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
    protected function shouldShrink()
    {
        // For shrinking, we need to check for the corner case in which
        // the internal array could shrink smaller than its initial size.
        // So we compute what would be size after the shrinking and check if
        // it happens.
        $sizeAfterShrink = count($this->buckets) / $this->scaleFactor;

        // If it is the case, we cancel the shrink operation since we want
        // to keep a minimum size for internal array.
        if ($sizeAfterShrink < self::INITIAL_SIZE) {
            return false;
        }

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

    /**
     * Resize the data structure if needed
     */
    protected function resizeIfNeeded()
    {
        if ($this->shouldGrow()) {
            $this->grow();
        } elseif ($this->shouldShrink()) {
            $this->shrink();
        }
    }
}
