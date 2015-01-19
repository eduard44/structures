<?php

namespace Chromabits\Structures\BinaryTree;

use Chromabits\Structures\Interfaces\NodeInterface;

/**
 * Class Node
 *
 * Represents a node inside a binary tree
 *
 * @package Chromabits\Structures\BinaryTree
 */
class Node implements NodeInterface
{

    /**
     * @var mixed
     */
    protected $content;

    /**
     * @var Node|null
     */
    protected $leftChild;

    /**
     * @var Node|null
     */
    protected $rightChild;

    /**
     * @var mixed
     */
    protected $key;

    /**
     * Construct an instance of a Node
     */
    public function __construct()
    {
        $this->key = null;
        $this->content = null;

        $this->leftChild = null;
        $this->rightChild = null;
    }

    /**
     * Set the key
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the key
     *
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
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
     * Get the left child node
     *
     * @return Node|null
     */
    public function getLeftChild()
    {
        return $this->leftChild;
    }

    /**
     * Set the left child node
     *
     * @param Node $leftChild
     */
    public function setLeftChild(Node $leftChild)
    {
        $this->leftChild = $leftChild;
    }

    /**
     * Get the right child node
     *
     * @return Node|null
     */
    public function getRightChild()
    {
        return $this->rightChild;
    }

    /**
     * Set the right child node
     *
     * @param Node $rightChild
     */
    public function setRightChild(Node $rightChild)
    {
        $this->rightChild = $rightChild;
    }

    /**
     * Returns whether or not this node is a leaf
     *
     * @return bool
     */
    public function isLeaf()
    {
        return is_null($this->leftChild) && is_null($this->rightChild);
    }
}
