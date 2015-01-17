<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\ArrayLinkedList;
use Chromabits\Structures\LinkedList\LinkedListIterator;
use Tests\Chromabits\Support\TestCase;

/**
 * Class LinkedListIteratorTest
 *
 * @package Tests\Chromabits\Structures\LinkedList
 */
class LinkedListIteratorTest extends TestCase
{
    public function testConstructor()
    {
        $iterator = new LinkedListIterator(new ArrayLinkedList());

        $this->assertInstanceOf('Chromabits\Structures\LinkedList\LinkedListIterator', $iterator);
        $this->assertInstanceOf('Iterator', $iterator);
    }

    public function testKey()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');
        $list->push('world');

        $iterator = new LinkedListIterator($list);

        $this->assertEquals(0, $iterator->key());
    }

    public function testKeyWithEmpty()
    {
        $list = new ArrayLinkedList();

        $iterator = new LinkedListIterator($list);

        $this->assertEquals(0, $iterator->key());
    }

    public function testCurrent()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');
        $list->push('world');

        $iterator = new LinkedListIterator($list);

        $this->assertEquals('world', $iterator->current());
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function testCurrentWithEmpty()
    {
        $list = new ArrayLinkedList();

        $iterator = new LinkedListIterator($list);

        $iterator->current();
    }

    /**
     * @depends testKey
     * @depends testCurrent
     */
    public function testNext()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');
        $list->push('world');

        $iterator = new LinkedListIterator($list);

        $this->assertEquals(0, $iterator->key());
        $this->assertEquals('world', $iterator->current());

        $iterator->next();

        $this->assertEquals(1, $iterator->key());
        $this->assertEquals('hello', $iterator->current());
    }

    /**
     * @depends testNext
     */
    public function testValid()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');
        $list->push('world');

        $iterator = new LinkedListIterator($list);

        $this->assertTrue($iterator->valid());

        $iterator->next();

        $this->assertTrue($iterator->valid());

        $iterator->next();

        $this->assertFalse($iterator->valid());
    }

    public function testValidWithEmpty()
    {
        $iterator = new LinkedListIterator(new ArrayLinkedList());

        $this->assertFalse($iterator->valid());
    }

    /**
     * @depends testNext
     * @depends testCurrent
     * @depends testKey
     */
    public function testRewind()
    {
        $list = new ArrayLinkedList();

        $list->push('hello');
        $list->push('world');
        $list->push('yeah');

        $iterator = new LinkedListIterator($list);

        $iterator->next();
        $iterator->next();

        $this->assertEquals('hello', $iterator->current());
        $this->assertEquals(2, $iterator->key());

        $iterator->rewind();

        $this->assertEquals('yeah', $iterator->current());
        $this->assertEquals(0, $iterator->key());
    }
}
