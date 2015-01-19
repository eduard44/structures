<?php

namespace Tests\Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Hashers\ScalarHasher;
use Tests\Chromabits\Support\TestCase;

/**
 * Class ScalarHasherTest
 *
 * @package Tests\Chromabits\Structures\Map\Hashers
 */
class ScalarHasherTest extends TestCase
{
    public function testConstructor()
    {
        $hasher = new ScalarHasher();

        $this->assertInstanceOf('Chromabits\Structures\Map\Hashers\ScalarHasher', $hasher);
        $this->assertInstanceOf('Chromabits\Structures\Map\Interfaces\HasherInterface', $hasher);
    }

    public function testHash()
    {
        $hasher = new ScalarHasher();

        $resultOne = $hasher->hash('hello world');
        $resultTwo = $hasher->hash(8759874.7532);
        $resultThree = $hasher->hash(['some' => 'array']);

        $this->assertTrue(is_numeric($resultOne));
        $this->assertTrue(is_numeric($resultTwo));
        $this->assertTrue(is_numeric($resultThree));
    }

    /**
     * @expectedException \Chromabits\Structures\Exceptions\InvalidOperationException
     */
    public function testHashWithInvalid()
    {
        $hasher = new ScalarHasher();

        $hasher->hash(new ScalarHasher());
    }
}
