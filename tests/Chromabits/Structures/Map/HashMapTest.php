<?php

namespace Tests\Chromabits\Structures\Map;

use Chromabits\Structures\Map\HashMap;
use Tests\Chromabits\Support\TestCase;

/**
 * Class HashMapTest
 *
 * @package Tests\Chromabits\Structures\Map
 */
class HashMapTest extends TestCase
{
    public function testConstructor()
    {
        $map = new HashMap();

        $this->assertInstanceOf('Chromabits\Structures\Map\HashMap', $map);
        $this->assertInstanceOf('Chromabits\Structures\Map\Interfaces\MapInterface', $map);
    }

    public function testSet()
    {
        $map = new HashMap();

        $map->set('hello', 'world');

        $this->assertTrue($map->has('hello'));

        $map->set('hello', 'world2');

        $this->assertTrue($map->has('hello'));
    }

    /**
     * @depends testSet
     */
    public function testGet()
    {
        $map = new HashMap();

        for ($i = 0; $i < 13; $i++) {
            $map->set('hai' . $i, 'there' . $i);
        }

        $this->assertEquals('there3', $map->get('hai3'));
    }

    /**
     * @depends testSet
     */
    public function testGetWithCollisions()
    {
        $map = new HashMap();

        $map->set('hello', 'world');

        $this->assertEquals('world', $map->get('hello'));

        $map->set('hello', 'world2');

        $this->assertEquals('world2', $map->get('hello'));
    }

    public function testGetWithEmpty()
    {
        $map = new HashMap();

        $this->assertNull($map->get('lol'));
    }

    /**
     * @depends testSet
     */
    public function testCount()
    {
        $map = new HashMap();

        $map->set('hello', 'world');
        $map->set('woah', 'what');
        $map->set('hello', 'world2');

        $this->assertEquals(2, $map->count());

        $map->set('code', 'structures');

        $this->assertEquals(3, $map->count());
    }

    public function testToArray()
    {
        $map = new HashMap();

        $map->set('hello', 'world');
        $map->set('woah', 'what');
        $map->set('hello', 'world2');

        $this->assertEquals(
            [
                'hello' => 'world2',
                'woah' => 'what'
            ],
            $map->toArray()
        );
    }

    public function testRemove()
    {
        $map = new HashMap();

        $map->set('hello', 'world');
        $map->set('woah', 'what');
        $map->set('hello', 'world2');

        $this->assertTrue($map->has('hello'));

        $map->remove('hello');

        $this->assertFalse($map->has('hello'));
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function testRemoveWithEmpty()
    {
        $map = new HashMap();

        $map->set('hello', 'world');
        $map->set('woah', 'what');
        $map->set('hello', 'world2');

        $map->remove('lol');
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function testRemoveWithCollisions()
    {
        $map = new HashMap();

        for ($i = 0; $i < 12; $i++) {
            $map->set('hello' . $i, 'world' . $i);
        }

        $map->remove('lol');
    }

    /**
     * @depends testSet
     * @depends testRemove
     */
    public function testIsEmpty()
    {
        $map = new HashMap();

        $this->assertTrue($map->isEmpty());

        $map->set('hello', 'world');
        $map->set('woah', 'what');
        $map->set('hello', 'world2');

        $this->assertFalse($map->isEmpty());

        $map->remove('hello');
        $map->remove('woah');

        $this->assertTrue($map->isEmpty());
    }

    public function testResizing()
    {
        $map = new HashMap();

        for ($i = 0; $i < 100; $i++) {
            $map->set('hello' . $i, 'world' . $i);
        }

        for ($i = 0; $i < 100; $i++) {
            $map->remove('hello' . $i);
        }
    }
}
