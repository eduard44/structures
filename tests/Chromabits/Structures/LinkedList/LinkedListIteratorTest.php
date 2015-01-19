<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\LinkedList;
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
        $iterator = new LinkedListIterator(new LinkedList());

        $this->assertInstanceOf('Chromabits\Structures\LinkedList\LinkedListIterator', $iterator);
        $this->assertInstanceOf('Iterator', $iterator);
    }

    public function testKey()
    {
        $list = new LinkedList();

        $list->push('hello');
        $list->push('world');

        $iterator = new LinkedListIterator($list);

        $this->assertEquals(0, $iterator->key());
    }

    public function testKeyWithEmpty()
    {
        $list = new LinkedList();

        $iterator = new LinkedListIterator($list);

        $this->assertEquals(0, $iterator->key());
    }

    public function testCurrent()
    {
        $list = new LinkedList();

        $list->push('hello');
        $list->push('world');

        $iterator = new LinkedListIterator($list);

        $this->assertEquals('world', $iterator->current());
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testCurrentWithEmpty()
    {
        $list = new LinkedList();

        $iterator = new LinkedListIterator($list);

        $iterator->current();
    }

    /**
     * @depends testKey
     * @depends testCurrent
     */
    public function testNext()
    {
        $list = new LinkedList();

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
        $list = new LinkedList();

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
        $iterator = new LinkedListIterator(new LinkedList());

        $this->assertFalse($iterator->valid());
    }

    /**
     * @depends testNext
     * @depends testCurrent
     * @depends testKey
     */
    public function testRewind()
    {
        $list = new LinkedList();

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
