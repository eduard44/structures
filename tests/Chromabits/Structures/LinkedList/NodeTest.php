<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\Node;
use Tests\Chromabits\Support\TestCase;

/**
 * Class NodeTest
 *
 * @package Tests\Chromabits\Structures\LinkedList
 */
class NodeTest extends TestCase
{
    public function testConstructor()
    {
        $instance = new Node('hi');

        $this->assertInstanceOf('Chromabits\Structures\LinkedList\Node', $instance);
    }

    public function testContentMutators()
    {
        $node = new Node('hi');

        $this->assertEquals('hi', $node->getContent());

        $node->setContent('hello');

        $this->assertEquals('hello', $node->getContent());
    }

    public function testNextMutators()
    {
        $node = new Node('hi');
        $nodeOther = new Node('hi');

        $this->assertEquals(null, $node->getNext());

        $node->setNext($nodeOther);

        $this->assertEquals($nodeOther, $node->getNext());
    }
}
