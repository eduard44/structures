<?php

namespace Tests\Chromabits\Structures\BinaryTree;

use Chromabits\Structures\BinaryTree\Node;
use Tests\Chromabits\Support\TestCase;

/**
 * Class NodeTest
 *
 * @package Tests\Chromabits\Structures\BinaryTree
 */
class NodeTest extends TestCase
{
    public function testConstructor()
    {
        $node = new Node();

        $this->assertInstanceOf('Chromabits\Structures\BinaryTree\Node', $node);
        $this->assertInstanceOf('Chromabits\Structures\Interfaces\NodeInterface', $node);
    }

    public function testContentMutators()
    {
        $node = new Node();

        $this->assertNull($node->getContent());

        $node->setContent('binary node');

        $this->assertEquals('binary node', $node->getContent());
    }

    public function testLeftChildMutators()
    {
        $node = new Node();
        $child = new Node();

        $this->assertNull($node->getLeftChild());

        $node->setLeftChild($child);

        $this->assertEquals($child, $node->getLeftChild());
    }

    public function testRightChildMutators()
    {
        $node = new Node();
        $child = new Node();

        $this->assertNull($node->getRightChild());

        $node->setRightChild($child);

        $this->assertEquals($child, $node->getRightChild());
    }

    public function testKeyMutators()
    {
        $node = new Node();

        $this->assertNull($node->getKey());

        $node->setKey('hi');

        $this->assertEquals('hi', $node->getKey());
    }

    public function testIsLeaf()
    {
        $leftChild = new Node();
        $rightChild = new Node();

        $one = new Node();
        $two = new Node();
        $three = new Node();
        $four = new Node();

        $two->setLeftChild($leftChild);

        $three->setRightChild($rightChild);

        $four->setLeftChild($leftChild);
        $four->setRightChild($rightChild);

        $this->assertTrue($one->isLeaf());
        $this->assertFalse($two->isLeaf());
        $this->assertFalse($three->isLeaf());
        $this->assertFalse($four->isLeaf());
    }

    public function testFlush()
    {
        $leftChild = new Node();
        $rightChild = new Node();

        $node = new Node();

        $node->setKey('hi');
        $node->setContent('hello');
        $node->setLeftChild($leftChild);
        $node->setRightChild($rightChild);

        $node->flush();

        $this->assertNull($node->getKey());
        $this->assertNull($node->getContent());
        $this->assertNull($node->getLeftChild());
        $this->assertNull($node->getRightChild());
    }
}
