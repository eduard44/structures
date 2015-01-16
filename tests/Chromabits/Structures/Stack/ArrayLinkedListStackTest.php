<?php

namespace Tests\Chromabits\Structures\Stack;

use Chromabits\Structures\Stack\ArrayLinkedListStack;
use Tests\Chromabits\Support\TestCase;

class ArrayLinkedListStackTest extends TestCase
{
    public function testConstructor()
    {
        $instance = new ArrayLinkedListStack();

        $this->assertInstanceOf('Chromabits\Structures\Stack\ArrayLinkedListStack', $instance);
        $this->assertInstanceOf('Chromabits\Structures\Stack\LinkedListStack', $instance);
        $this->assertInstanceOf('Chromabits\Structures\Stack\Interfaces\StackInterface', $instance);
    }

    public function testPushAndTop()
    {
        $stack = new ArrayLinkedListStack();

        $stack->push('hi');

        $this->assertTrue('hi', $stack->top()->getContent());
    }

    public function testPop()
    {
        $stack = new ArrayLinkedListStack();

        $one = $stack->push('hi');

        $two = $stack->pop();

        $this->assertNull($stack->top());
        $this->assertEquals($one, $two);

        $stack->push('hello');
        $stack->push('world');

        $stack->pop();

        $this->assertEquals('hello', $stack->top()->getContent());

        $stack->pop();

        $this->assertNull($stack->top());

        $this->assertNull($stack->pop());
    }

    public function testCount()
    {
        $stack = new ArrayLinkedListStack();

        $stack->push('hello');

        $this->assertEquals(1, $stack->count());

        $stack->push('world');

        $this->assertEquals(2, $stack->count());
    }

    public function testFlush()
    {
        $stack = new ArrayLinkedListStack();

        $stack->push('hello');
        $stack->push('world');

        $this->assertEquals(2, $stack->count());

        $stack->flush();

        $this->assertEquals(0, $stack->count());
        $this->assertNull($stack->top());
    }

    public function testIsEmpty()
    {
        $stack = new ArrayLinkedListStack();

        $this->assertTrue($stack->isEmpty());

        $stack->push('hello');

        $this->assertFalse($stack->isEmpty());
    }
}
