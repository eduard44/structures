<?php

namespace Chromabits\Structures\Map;

use Chromabits\Structures\Interfaces\NodeInterface;

/**
 * Class Node
 *
 * @package Chromabits\Structures\Map
 */
class Node implements NodeInterface
{

    /**
     * The value
     *
     * @var mixed
     */
    protected $content;

    /**
     * They key of the object
     *
     * @var mixed
     */
    protected $key;

    /**
     * Construct an instance of a Node
     */
    public function __construct()
    {
        $this->content = null;

        $this->key = null;
    }

    /**
     * Get the content of the node
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content of the node
     *
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
}
