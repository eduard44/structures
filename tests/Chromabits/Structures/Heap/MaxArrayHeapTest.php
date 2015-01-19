<?php

namespace Tests\Chromabits\Structures\Heap;

use Chromabits\Structures\Heap\MaxArrayHeap;
use Tests\Chromabits\Support\TestCase;

/**
 * Class MaxArrayHeapTest
 *
 * @package Tests\Chromabits\Structures\Heap
 */
class MaxArrayHeapTest extends TestCase
{
    public function testConstructor()
    {
        $instance = new MaxArrayHeap();

        $this->assertInstanceOf('Chromabits\Structures\Heap\MaxArrayHeap', $instance);
        $this->assertInstanceOf('Chromabits\Structures\Heap\ArrayHeap', $instance);
        $this->assertInstanceOf('Chromabits\Structures\Heap\Interfaces\HeapInterface', $instance);
    }

    public function testInsertAndCount()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);
        $heap->insert(9);
        $heap->insert(11);

        $this->assertEquals(3, $heap->count());
    }

    public function testGet()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);

        $this->assertEquals(10, $heap->get(0));
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testGetWithInvalid()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);

        $heap->get(90);
    }

    public function testGetOrNull()
    {
        $heap = new MaxArrayHeap();

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
        $heap = new MaxArrayHeap();

        $heap->insert(10);
        $heap->insert(9);
        $heap->insert(11);

        $this->assertEquals(11, $heap->top());

        $this->assertEquals(9, $heap->get(1));
        $this->assertEquals(10, $heap->get(2));
    }

    public function testExchange()
    {
        $input = [10, 30, 20];

        MaxArrayHeap::exchange($input, 1, 2);

        $this->assertEquals(10, $input[0]);
        $this->assertEquals(20, $input[1]);
        $this->assertEquals(30, $input[2]);
    }

    /**
     * @expectedException \Chromabits\Nucleus\Exceptions\IndexOutOfBoundsException
     */
    public function testExchangeWithInvalidBounds()
    {
        $input = [10, 30, 20];

        MaxArrayHeap::exchange($input, 1, 4);
    }

    public function testGetParentIndex()
    {
        $this->assertEquals(0, MaxArrayHeap::getParentIndex(0));

        $this->assertEquals(0, MaxArrayHeap::getParentIndex(1));

        $this->assertEquals(0, MaxArrayHeap::getParentIndex(2));

        $this->assertEquals(1, MaxArrayHeap::getParentIndex(3));

        $this->assertEquals(4, MaxArrayHeap::getParentIndex(10));

        $this->assertEquals(7, MaxArrayHeap::getParentIndex(15));
    }

    public function testGetLeftIndex()
    {
        $this->assertEquals(1, MaxArrayHeap::getLeftIndex(0));

        $this->assertEquals(3, MaxArrayHeap::getLeftIndex(1));
    }

    public function testGetRightIndex()
    {
        $this->assertEquals(2, MaxArrayHeap::getRightIndex(0));

        $this->assertEquals(4, MaxArrayHeap::getRightIndex(1));
    }

    public function testIncrease()
    {
        $input = [16, 14, 10, 8, 7, 9, 3, 2, 4, 1];

        MaxArrayHeap::increase($input, 8, 15);

        $this->assertEquals(15, $input[1]);
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function testDecreaseWithInvalid()
    {
        $input = [10, 20, 30, 40, 50, 60];

        MaxArrayHeap::increase($input, 5, 30);
    }

    public function testHeapify()
    {
        $heap = new MaxArrayHeap();

        $heap->heapify([10, 20, 30, 40, 50, 60]);

        $this->assertEquals(60, $heap->top());

        $this->assertLessThan($heap->top(), $heap->get(1));
        $this->assertLessThan($heap->top(), $heap->get(2));
    }

    public function testMinHeapify()
    {
        $input = [30, 20, 80, 50, 10, 60];

        MaxArrayHeap::maxHeapify($input, 2);

        $this->assertEquals(80, $input[2]);
        $this->assertEquals(60, $input[5]);

        MaxArrayHeap::maxHeapify($input, 0);

        $this->assertEquals(80, $input[0]);
        $this->assertEquals(60, $input[2]);
        $this->assertEquals(30, $input[5]);
    }

    public function testTop()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);

        $this->assertEquals(10, $heap->top());
    }

    public function testTopWithEmpty()
    {
        $heap = new MaxArrayHeap();

        $this->assertNull($heap->top());
    }

    public function testFlush()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);
        $heap->insert(5);
        $heap->insert(1);

        $this->assertEquals(3, $heap->count());

        $heap->flush();

        $this->assertEquals(0, $heap->count());
    }

    public function testIsEmpty()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);
        $heap->insert(5);
        $heap->insert(1);

        $this->assertFalse($heap->isEmpty());

        $heap->flush();

        $this->assertTrue($heap->isEmpty());
    }

    public function testToArray()
    {
        $heap = new MaxArrayHeap();

        $heap->insert(10);
        $heap->insert(5);
        $heap->insert(1);

        $output = $heap->toArray();

        $this->assertEquals([10, 5, 1], $output);
    }
}
