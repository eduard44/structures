<?php

namespace Chromabits\Structures\BinaryTree;

use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\Interfaces\Emptyable;
use Chromabits\Structures\Interfaces\Flushable;
use Chromabits\Structures\Stack\ArrayLinkedListStack;
use Chromabits\Structures\Stack\Interfaces\StackInterface;

/**
 * Class BinaryTree
 *
 * A binary tree implementation
 *
 * @package Chromabits\Structures\BinaryTree
 */
class BinaryTree implements Countable, Emptyable, Flushable
{
    /**
     * This is a reference to the root of the tree
     *
     * @var \Chromabits\Structures\BinaryTree\Node|null
     */
    protected $root;

    /**
     * Get the current number of elements in this instance
     */
    public function count()
    {
        $count = 0;

        $this->depthTraversal(function (Node $node) use (&$count) {
            $count = $count + 1;
        });

        return $count;
    }

    /**
     * Start a depth-first search at the specified node
     *
     * The provided callback will be called on every node of the tree
     *
     * @param callable $callback
     * @param \Chromabits\Structures\BinaryTree\Node $start
     */
    public function depthTraversal(callable $callback, Node $start = null)
    {
        if (is_null($start)) {
            if (is_null($this->root)) {
                return;
            } else {
                $start = $this->root;
            }
        }

        $stack = new ArrayLinkedListStack();

        $stackRootNode = $stack->push([
            'node' => $start,
            'left' => 'false',
            'right' => 'false',
            'explored' => 'false'
        ]);
        $stackRoot = $stackRootNode->getContent();

        while (true) {
            if ($stackRoot['right'] === 'true' || $stack->count() < 1) {
                break;
            } else if (is_null($stack->top()->getContent()['node'])) {
                // If the node is null, then it does not exists, therefore we
                // just need to back track
                $stack->pop();

                continue;
            }

            $top = $stack->top()->getContent();

            if ($top['left'] === 'false') {
                $this->depthTraverseLeft($stack);
            } elseif ($top['right'] === 'false') {
                $this->depthTraverseRight($stack);
            } elseif ($top['explored'] === 'false') {
                $this->depthTraversalExplore($callback, $stack);
            } elseif ($top['right'] === 'true' && $top['left'] === 'true') {
                $stack->pop();
            }
        }
    }

    /**
     * Depth traverse to the left
     *
     * @param \Chromabits\Structures\Stack\Interfaces\StackInterface $stack
     */
    protected function depthTraverseLeft(StackInterface $stack)
    {
        $top = $stack->top()->getContent();

        // Descend to the left
        $top['left'] = 'true';

        $stack->top()->setContent($top);

        $stack->push([
            'node' => $top['node']->getLeftChild(),
            'right' => 'false',
            'left' => 'false',
            'explored' => 'false'
        ]);
    }

    /**
     * Depth traverse to the right
     *
     * @param \Chromabits\Structures\Stack\Interfaces\StackInterface $stack
     */
    protected function depthTraverseRight(StackInterface $stack)
    {
        $top = $stack->top()->getContent();

        // Descend to the right
        $top['right'] = 'true';

        $stack->top()->setContent($top);

        $stack->push([
            'node' => $top['node']->getRightChild(),
            'right' => 'false',
            'left' => 'false',
            'explored' => 'false'
        ]);
    }

    /**
     * Call the callback for the node
     *
     * @param callable $callback
     * @param \Chromabits\Structures\Stack\Interfaces\StackInterface $stack
     */
    protected function depthTraversalExplore(callable $callback, StackInterface $stack)
    {
        $top = $stack->top()->getContent();

        // Call the callback function with the current element
        $callback($top['node']);

        $top['explored'] = 'true';

        $stack->top()->setContent($top);
    }

    /**
     * Returns whether or not the set is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return is_null($this->root);
    }

    /**
     * Clear all elements of this instance and restore it
     * to its original state
     *
     * @return mixed
     */
    public function flush()
    {
        $this->depthTraversal(function (Node $node) {
            $node->flush();
        });

        $this->root = null;
    }

    /**
     * Return an array with the result of performing a preorder traversal of a
     * tree.
     *
     * @return array
     */
    public function preorder()
    {
        $result = [];

        $this->preorderTraversal($this->root, $result);

        return $result;
    }

    /**
     * Recursive step of preorder traversal.
     *
     * @param Node $node
     * @param array $result
     */
    protected function preorderTraversal(Node $node, array &$result)
    {
        $result[] = $node->getContent();

        $left = $node->getLeftChild();
        $right = $node->getRightChild();

        if ($left !== null) {
            $this->preorderTraversal($left, $result);
        }

        if ($right !== null) {
            $this->preorderTraversal($right, $result);
        }
    }
}
