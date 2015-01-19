<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\LinkedList;
use Tests\Chromabits\Support\TestCase;

/**
 * Class LinkedListTest
 *
 * @package Tests\Chromabits\Structures\LinkedList
 */
class LinkedListTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf(
            [
                'Chromabits\Structures\LinkedList\LinkedList',
                'Chromabits\Structures\LinkedList\Interfaces\LinkedListInterface'
            ],
            $this->make()
        );
    }

    protected function make()
    {
        return new LinkedList();
    }

    public function testPushAndCount()
    {
        $list = $this->make();

        $this->assertEquals(0, $list->count());

        $list->push('hello');

        $this->assertEquals(1, $list->count());
    }

    /**
     * @depends testPushAndCount
     */
    public function testGet()
    {
        $list = $this->make();

        $list->push('hello');

        $this->assertEquals('hello', $list->get(0)->getContent());
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testGetWithEmpty()
    {
        $list = $this->make();

        $list->get(0);
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testGetWithInvalid()
    {
        $list = $this->make();

        $list->push('hello');

        $list->get(99);
    }

    public function testPopSingle()
    {
        $list = $this->make();

        $nodeOne = $list->push('hello');

        $this->assertEquals(1, $list->count());

        $nodeTwo = $list->pop();

        $this->assertEquals($nodeOne, $nodeTwo);
        $this->assertEquals(0, $list->count());

        $this->assertEquals(null, $list->pop());
    }

    public function testPopMultiple()
    {
        $list = $this->make();

        $nodeOne = $list->push('hello');
        $nodeTwo = $list->push('hello2');

        $this->assertEquals(2, $list->count());

        $nodeThree = $list->pop();

        $this->assertEquals($nodeTwo, $nodeThree);
        $this->assertEquals(1, $list->count());

        $nodeFour = $list->pop();

        $this->assertEquals($nodeOne, $nodeFour);
        $this->assertEquals(0, $list->count());

        $this->assertEquals(null, $list->pop());
    }

    public function testIsEmpty()
    {
        $list = $this->make();

        $this->assertTrue($list->isEmpty());

        $list->push('hello');

        $this->assertFalse($list->isEmpty());

        $list->push('hello2');

        $this->assertFalse($list->isEmpty());
    }

    public function testFlush()
    {
        $list = $this->make();

        $list->push('hello');
        $list->push('hello2');

        $this->assertEquals(2, $list->count());

        $list->flush();

        $this->assertEquals(0, $list->count());
    }

    public function testHead()
    {
        $list = $this->make();

        $two = $list->push('hello2');
        $one = $list->push('hello');

        $this->assertEquals($two, $list->head());
        $this->assertNotEquals($one, $list->head());
    }

    public function testTail()
    {
        $list = $this->make();

        $two = $list->push('hello2');
        $one = $list->push('hello');

        $this->assertEquals($one, $list->tail());
        $this->assertNotEquals($two, $list->tail());
    }

    public function testRemove()
    {
        $list = $this->make();

        $list->push('hello2');
        $list->push('hello');
        $list->push('hello3');

        $this->assertEquals(3, $list->count());

        $list->remove(1);

        $this->assertEquals(2, $list->count());
        $this->assertEquals(['hello3', 'hello2'], $list->toArray());

        $list->remove(1);

        $this->assertEquals(1, $list->count());
        $this->assertEquals(['hello3'], $list->toArray());
        $this->assertEquals($list->head(), $list->tail());

        $list->remove(0);

        $this->assertEquals(0, $list->count());
        $this->assertEquals([], $list->toArray());
        $this->assertNull($list->head());
        $this->assertNull($list->tail());

        $list->push('hello2');
        $list->push('hello');
        $list->push('hello3');

        $list->remove(0);

        $this->assertEquals(['hello', 'hello2'], $list->toArray());
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testRemoveWithEmpty()
    {
        $list = $this->make();

        $list->remove(0);
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testRemoveOutOfBounds()
    {
        $list = $this->make();

        $list->push('hello2');
        $list->push('hello');
        $list->push('hello3');

        $list->remove(99);
    }

    public function testHas()
    {
        $list = $this->make();

        $list->push('hello2');
        $list->push('hello');
        $list->push('hello3');

        $this->assertFalse($list->has('not here'));
        $this->assertTrue($list->has('hello'));
        $this->assertTrue($list->has('hello2'));
        $this->assertTrue($list->has('hello3'));
    }
}
