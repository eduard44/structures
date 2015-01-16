<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\ArrayLinkedList;
use Tests\Chromabits\Support\TestCase;

/**
 * Class ArrayLinkedListTest
 *
 * @package Tests\Chromabits\Structures\LinkedList
 */
class ArrayLinkedListTest extends TestCase
{
    public function testConstructor()
    {
        $instance = new ArrayLinkedList();

        $this->assertInstanceOf('Chromabits\Structures\LinkedList\ArrayLinkedList', $instance);
    }

    public function testPushAndCount()
    {
        $list = new ArrayLinkedList();

        $this->assertEquals(0, $list->count());

        $list->push('hello');

        $this->assertEquals(1, $list->count());
    }

    /**
     * @depends testPushAndCount
     */
    public function testGet()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');

        $this->assertEquals('hello', $list->get(0)->getContent());
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\IndexOutOfBoundException
     */
    public function testGetWithEmpty()
    {
        $list = new ArrayLinkedList();

        $list->get(0);
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\IndexOutOfBoundException
     */
    public function testGetWithInvalid()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');

        $list->get(99);
    }

    public function testPopSingle()
    {
        $list = new ArrayLinkedList();

        $nodeOne = $list->push('hello');

        $this->assertEquals(1, $list->count());

        $nodeTwo = $list->pop();

        $this->assertEquals($nodeOne, $nodeTwo);
        $this->assertEquals(0, $list->count());

        $this->assertEquals(null, $list->pop());
    }

    public function testPopMultiple()
    {
        $list = new ArrayLinkedList();

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
        $list = new ArrayLinkedList();

        $this->assertTrue($list->isEmpty());

        $list->push('hello');

        $this->assertFalse($list->isEmpty());

        $list->push('hello2');

        $this->assertFalse($list->isEmpty());
    }

    public function testFlush()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');
        $list->push('hello2');

        $this->assertEquals(2, $list->count());

        $list->flush();

        $this->assertEquals(0, $list->count());
    }
}
