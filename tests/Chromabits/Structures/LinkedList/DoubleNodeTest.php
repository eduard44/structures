<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\DoubleNode;

/**
 * Class DoubleNodeTest
 *
 * @package Tests\Chromabits\Structures\LinkedList
 */
class DoubleNodeTest extends NodeTest
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Structures\LinkedList\DoubleNode',
                'Chromabits\Structures\LinkedList\Node',
                'Chromabits\Structures\Interfaces\NodeInterface',
            ],
            new DoubleNode('hi')
        );
    }

    public function testPreviousMutators()
    {
        $node = new DoubleNode('hi');
        $nodeOther = new DoubleNode('hi');

        $this->assertNull($node->getPrevious());

        $node->setPrevious($nodeOther);

        $this->assertEquals($nodeOther, $node->getPrevious());
    }

    public function testFlushPrevious()
    {
        $node = new DoubleNode('hi');
        $nodeOther = new DoubleNode('hi');

        $node->setPrevious($nodeOther);

        $node->flushPrevious();

        $this->assertNull($node->getPrevious());
    }

    /**
     * @depends testFlushPrevious
     */
    public function testFlush()
    {
        $node = new DoubleNode('hi');
        $nodeOther = new DoubleNode('hi');

        $node->setContent('hello');
        $node->setNext($nodeOther);
        $node->setPrevious($nodeOther);

        $node->flush();

        $this->assertNull($node->getContent());
        $this->assertNull($node->getNext());
        $this->assertNull($node->getPrevious());
    }
}
