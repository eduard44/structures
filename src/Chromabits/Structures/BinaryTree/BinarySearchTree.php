<?php

namespace Chromabits\Structures\BinaryTree;

use Chromabits\Sorting\Comparators\NumericComparator;
use Chromabits\Sorting\Interfaces\ComparatorInterface;

/**
 * Class BinarySearchTree
 *
 * @package Chromabits\Structures\BinaryTree
 */
class BinarySearchTree extends BinaryTree
{

    /**
     * Internal comparator
     *
     * @var \Chromabits\Sorting\Interfaces\ComparatorInterface
     */
    protected $comparator;

    /**
     * Construct an instance of a BinaryTree
     *
     * @param \Chromabits\Sorting\Interfaces\ComparatorInterface $comparator
     */
    public function __construct(ComparatorInterface $comparator = null)
    {
        $this->root = null;

        $this->comparator = (is_null($comparator)) ? new NumericComparator() : $comparator;
    }

    /**
     * Insert a record into the tree
     *
     * @param mixed $key
     * @param mixed|null $value
     *
     * @return \Chromabits\Structures\BinaryTree\Node
     */
    public function push($key, $value = null)
    {
        // If the tree is completely empty, we consider
        // this new record to be the root
        if (is_null($this->root)) {
            $node = $this->makeNode($key, $value);

            $this->root = $node;

            return $node;
        }

        // Otherwise, we have to find the right place for the new node
        return $this->compareAndInsert($this->root, $key, $value);
    }

    /**
     * Create a binary tree node
     *
     * @param $key
     * @param $value
     *
     * @return \Chromabits\Structures\BinaryTree\Node
     */
    protected function makeNode($key, $value)
    {
        $node = new Node();

        $node->setKey($key);
        $node->setContent($value);

        return $node;
    }

    /**
     * Locate an empty spot using comparison for a new node
     * and create it
     *
     * @param \Chromabits\Structures\BinaryTree\Node $parentNode
     * @param mixed $key
     * @param mixed|null $value
     *
     * @return \Chromabits\Structures\BinaryTree\Node
     */
    protected function compareAndInsert(Node $parentNode, $key, $value = null)
    {
        $parentKey = $parentNode->getKey();

        $comparison = $this->comparator->compare($parentKey, $key);

        if ($comparison > 0) {
            if (is_null($parentNode->getLeftChild())) {
                $node = $this->makeNode($key, $value);

                $parentNode->setLeftChild($node);

                return $node;
            } else {
                return $this->compareAndInsert($parentNode->getLeftChild(), $key, $value);
            }
        } else {
            if (is_null($parentNode->getRightChild())) {
                $node = $this->makeNode($key, $value);

                $parentNode->setRightChild($node);

                return $node;
            } else {
                return $this->compareAndInsert($parentNode->getRightChild(), $key, $value);
            }
        }
    }

    /**
     * Try to find the specified key in the tree
     *
     * @param $key
     *
     * @return \Chromabits\Structures\BinaryTree\Node|null
     */
    public function search($key)
    {
        $current = $this->root;

        while (!is_null($current)) {
            $comparison = $this->comparator->compare($key, $current->getKey());

            // If the key matches the root, then just return the root
            if ($comparison == 0) {
                return $current;
            } elseif ($comparison < 0) {
                $current = $current->getLeftChild();
            } else {
                $current = $current->getRightChild();
            }
        }

        return null;
    }
}
