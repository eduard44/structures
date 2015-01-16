<?php

namespace Chromabits\Structures\Interfaces;

/**
 * Interface NodeInterface
 *
 * Represents a single unit of a data structure which can
 * contain a value or reference to another class instance
 *
 * @package Chromabits\Structures\LinkedList
 */
interface NodeInterface
{
    /**
     * Set the content of the node
     *
     * @param $content
     */
    public function setContent($content);

    /**
     * Get the content of the node
     *
     * @return mixed
     */
    public function getContent();
}
