<?php

namespace Chromabits\Structures\Stack\Interfaces;

/**
 * Interfaces StackInterface
 *
 * Represents methods that should be defined by an implementation
 * of a stack data structure
 *
 * @package src\Chromabits\Structures\Stack
 */
interface StackInterface
{
    /**
     * Push an element to the stack
     *
     * @param $content
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface
     */
    public function push($content);

    /**
     * Pop an element from the stack
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface|null
     */
    public function pop();

    /**
     * Get the top element of the stack
     *
     * @return \Chromabits\Structures\Interfaces\NodeInterface|null
     */
    public function top();
}
