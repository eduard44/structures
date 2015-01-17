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

        $map->set('hello', 'world');

        $this->assertEquals('world', $map->get('hello'));

        $map->set('hello', 'world2');

        $this->assertEquals('world2', $map->get('hello'));
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
}
