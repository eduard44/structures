<?php

namespace Tests\Chromabits\Structures\Heap;

use Chromabits\Structures\Heap\MinArrayHeap;
use Tests\Chromabits\Support\TestCase;

/**
 * Class MinArrayHeapTest
 *
 * @package Tests\Chromabits\Structures\Heap
 */
class MinArrayHeapTest extends TestCase
{
    public function testConstructor()
    {
        $instance = new MinArrayHeap();

        $this->assertInstanceOf('Chromabits\Structures\Heap\MinArrayHeap', $instance);
        $this->assertInstanceOf('Chromabits\Structures\Heap\ArrayHeap', $instance);
        $this->assertInstanceOf('Chromabits\Structures\Heap\Interfaces\HeapInterface', $instance);
    }

    public function testInsertAndCount()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);
        $heap->insert(9);
        $heap->insert(11);

        $this->assertEquals(3, $heap->count());
    }

    public function testGet()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);

        $this->assertEquals(10, $heap->get(0));
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function testGetWithInvalid()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);

        $heap->get(90);
    }

    public function testGetOrNull()
    {
        $heap = new MinArrayHeap();

        $this->assertNull($heap->getOrNull(80));

        $heap->insert(10);

        $this->assertEquals(10, $heap->getOrNull(0));
    }

    /**
     * @depends testGet
     * @depends testInsertAndCount
     */
    public function testInsertMaintainsHeapProperty()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);
        $heap->insert(9);
        $heap->insert(11);

        $this->assertEquals(9, $heap->top());

        $this->assertEquals(10, $heap->get(1));
        $this->assertEquals(11, $heap->get(2));
    }

    public function testExchange()
    {
        $input = [10, 30, 20];

        MinArrayHeap::exchange($input, 1, 2);

        $this->assertEquals(10, $input[0]);
        $this->assertEquals(20, $input[1]);
        $this->assertEquals(30, $input[2]);
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\IndexOutOfBoundsException
     */
    public function testExchangeWithInvalidBounds()
    {
        $input = [10, 30, 20];

        MinArrayHeap::exchange($input, 1, 4);
    }

    public function testGetParentIndex()
    {
        $this->assertEquals(0, MinArrayHeap::getParentIndex(0));

        $this->assertEquals(0, MinArrayHeap::getParentIndex(1));

        $this->assertEquals(0, MinArrayHeap::getParentIndex(2));

        $this->assertEquals(1, MinArrayHeap::getParentIndex(3));

        $this->assertEquals(4, MinArrayHeap::getParentIndex(10));

        $this->assertEquals(7, MinArrayHeap::getParentIndex(15));
    }

    public function testGetLeftIndex()
    {
        $this->assertEquals(1, MinArrayHeap::getLeftIndex(0));

        $this->assertEquals(3, MinArrayHeap::getLeftIndex(1));
    }

    public function testGetRightIndex()
    {
        $this->assertEquals(2, MinArrayHeap::getRightIndex(0));

        $this->assertEquals(4, MinArrayHeap::getRightIndex(1));
    }

    public function testDecrease()
    {
        $input = [10, 20, 30, 40, 50, 60];

        MinArrayHeap::decrease($input, 5, 6);

        $this->assertEquals(6, $input[0]);
        $this->assertEquals(10, $input[2]);
        $this->assertEquals(30, $input[5]);
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function testDecreaseWithInvalid()
    {
        $input = [10, 20, 30, 40, 50, 60];

        MinArrayHeap::decrease($input, 5, 80);
    }

    public function testHeapify()
    {
        $heap = new MinArrayHeap();

        $heap->heapify([10, 20, 30, 40, 50, 60]);

        $this->assertEquals(10, $heap->top());

        $this->assertGreaterThan($heap->top(), $heap->get(1));
        $this->assertGreaterThan($heap->top(), $heap->get(2));
    }

    public function testMinHeapify()
    {
        $input = [30, 20, 80, 50, 10, 60];

        MinArrayHeap::minHeapify($input, 2);

        $this->assertEquals(60, $input[2]);
        $this->assertEquals(80, $input[5]);

        MinArrayHeap::minHeapify($input, 0);

        $this->assertEquals(20, $input[0]);
        $this->assertEquals(10, $input[1]);
        $this->assertEquals(30, $input[4]);
    }

    public function testTop()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);

        $this->assertEquals(10, $heap->top());
    }

    public function testTopWithEmpty()
    {
        $heap = new MinArrayHeap();

        $this->assertNull($heap->top());
    }

    public function testFlush()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);
        $heap->insert(5);
        $heap->insert(1);

        $this->assertEquals(3, $heap->count());

        $heap->flush();

        $this->assertEquals(0, $heap->count());
    }

    public function testIsEmpty()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);
        $heap->insert(5);
        $heap->insert(1);

        $this->assertFalse($heap->isEmpty());

        $heap->flush();

        $this->assertTrue($heap->isEmpty());
    }

    public function testToArray()
    {
        $heap = new MinArrayHeap();

        $heap->insert(10);
        $heap->insert(5);
        $heap->insert(1);

        $output = $heap->toArray();

        $this->assertEquals([1, 10, 5], $output);
    }
}
