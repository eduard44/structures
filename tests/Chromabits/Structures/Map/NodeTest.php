<?php

namespace Tests\Chromabits\Structures\Map;

use Chromabits\Structures\Map\Node;
use Tests\Chromabits\Support\TestCase;

/**
 * Class NodeTest
 *
 * @package Tests\Chromabits\Structures\Map
 */
class NodeTest extends TestCase
{
    public function testConstructor()
    {
        $node = new Node();

        $this->assertInstanceOf('Chromabits\Structures\Map\Node', $node);
        $this->assertInstanceOf('Chromabits\Structures\Interfaces\NodeInterface', $node);
    }

    public function testKeyMutators()
    {
        $node = new Node();

        $this->assertNull($node->getKey());

        $node->setKey('hello');

        $this->assertEquals('hello', $node->getKey());
    }

    public function testContentMutators()
    {
        $node = new Node();

        $this->assertNull($node->getContent());

        $node->setContent('hello');

        $this->assertEquals('hello', $node->getContent());
    }
}
