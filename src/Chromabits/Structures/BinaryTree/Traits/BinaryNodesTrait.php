<?php

namespace Chromabits\Structures\BinaryTree\Traits;

/**
 * Class BinaryNodesTrait
 *
 * Combines functionality used by binary-tree-based structures
 * which use an array-like structure for storing nodes
 *
 * @package Chromabits\Structures\BinaryTree\Traits
 */
trait BinaryNodesTrait
{
    /**
     * Get the index of the parent node of a node
     *
     * @param $index
     *
     * @return int
     */
    public static function getParentIndex($index)
    {
        if ($index != 0) {
            $index--;
        }

        return (int)floor($index / 2.0);
    }

    /**
     * Get the index of the left child of a node
     *
     * @param $index
     *
     * @return int
     */
    public static function getLeftIndex($index)
    {
        return (2 * $index) + 1;
    }

    /**
     * Get the index of the right child of a node
     *
     * @param $index
     *
     * @return int
     */
    public static function getRightIndex($index)
    {
        return (2 * $index) + 2;
    }
}
