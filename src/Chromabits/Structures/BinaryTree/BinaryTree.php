<?php

namespace Chromabits\Structures\BinaryTree;

use Chromabits\Structures\Interfaces\Countable;
use Chromabits\Structures\Stack\ArrayLinkedListStack;

/**
 * Class BinaryTree
 *
 * A binary tree implementation
 *
 * @package Chromabits\Structures\BinaryTree
 */
class BinaryTree implements Countable
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

        $callback($start);

        $stackRootNode = $stack->push([
            'node' => $start,
            'left' => 'false',
            'right' => 'false',
            'explored' => 'true'
        ]);
        $stackRoot = $stackRootNode->getContent();

        while (true) {
            if ($stackRoot['right'] === 'true' || $stack->count() < 1) {
                break;
            }

            $top = $stack->top()->getContent();

            // If the node is null, then it does not exists, therefore we
            // just need to back track
            if (is_null($top['node'])) {
                $stack->pop();

                continue;
            }

            if ($top['explored'] === 'false') {
                // Call the callback function with the current element
                $callback($top['node']);

                $top['explored'] = 'true';

                $stack->top()->setContent($top);
            } elseif ($top['left'] === 'false') {
                // Descend to the left
                $top['left'] = 'true';

                $stack->top()->setContent($top);

                $stack->push([
                    'node' => $top['node']->getLeftChild(),
                    'right' => 'false',
                    'left' => 'false',
                    'explored' => 'false'
                ]);
            } elseif ($top['right'] === 'false') {
                // Descend to the right
                $top['right'] = 'true';

                $stack->top()->setContent($top);

                $stack->push([
                    'node' => $top['node']->getRightChild(),
                    'right' => 'false',
                    'left' => 'false',
                    'explored' => 'false'
                ]);
            } elseif ($top['right'] === 'true' && $top['left'] === 'true') {
                $stack->pop();
            }
        }
    }
}
