<?php

namespace Tests\Chromabits\Structures\LinkedList;

use Chromabits\Structures\LinkedList\DoublyLinkedList;

/**
 * Class DoublyLinkedListTest
 *
 * @package Tests\Chromabits\Structures\LinkedList
 */
class DoublyLinkedListTest extends LinkedListTest
{
    protected function make()
    {
        return new DoublyLinkedList();
    }
}
