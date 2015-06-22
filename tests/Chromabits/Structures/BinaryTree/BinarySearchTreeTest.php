<?php

namespace Tests\Chromabits\Structures\BinaryTree;

use Chromabits\Structures\BinaryTree\BinarySearchTree;
use Tests\Chromabits\Support\TestCase;

/**
 * Class BinarySearchTreeTest
 *
 * @package Tests\Chromabits\Structures\BinaryTree
 */
class BinarySearchTreeTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Structures\BinaryTree\BinarySearchTree'
            ],
            new BinarySearchTree()
        );
    }

    public function testCount()
    {
        $tree = new BinarySearchTree();

        $tree->push(10);

        $this->assertEquals(1, $tree->count());

        $tree->push(5);
        $tree->push(15);

        $this->assertEquals(3, $tree->count());

        $tree->push(3);
        $tree->push(20);

        $this->assertEquals(5, $tree->count());
    }

    public function testDepthTraversalWithEmpty()
    {
        $tree = new BinarySearchTree();

        $tree->depthTraversal(function () {

        });
    }

    public function testSearch()
    {
        $tree = new BinarySearchTree();

        $tree->push(10);
        $tree->push(5);
        $tree->push(15);
        $tree->push(3);
        $tree->push(20);
        $tree->push(9);

        $this->assertEquals(10, $tree->search(10)->getKey());
        $this->assertEquals(15, $tree->search(15)->getKey());
        $this->assertEquals(3, $tree->search(3)->getKey());
        $this->assertEquals(9, $tree->search(9)->getKey());
        $this->assertNull($tree->search(90));
    }

    public function testIsEmpty()
    {
        $tree = new BinarySearchTree();

        $this->assertTrue($tree->isEmpty());

        $tree->push(3);
        $tree->push(20);
        $tree->push(9);

        $this->assertFalse($tree->isEmpty());
    }

    /**
     * @depends testIsEmpty
     */
    public function testFlush()
    {
        $tree = new BinarySearchTree();

        $this->assertTrue($tree->isEmpty());

        $tree->push(3);
        $tree->push(20);
        $tree->push(9);

        $tree->flush();

        $this->assertTrue($tree->isEmpty());
    }

    public function testPreorder()
    {
        $tree = new BinarySearchTree();

        $tree->push(8, 8);
        $tree->push(3, 3);
        $tree->push(10, 10);
        $tree->push(1, 1);
        $tree->push(6, 6);
        $tree->push(4, 4);
        $tree->push(7, 7);
        $tree->push(14, 14);
        $tree->push(13, 13);

        $this->assertEquals(
            [8, 3, 1, 6, 4, 7, 10, 14, 13],
            $tree->preorder()
        );
    }
}
