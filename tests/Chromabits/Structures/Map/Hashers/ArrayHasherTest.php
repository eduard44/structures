<?php

namespace Tests\Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Hashers\ArrayHasher;
use Tests\Chromabits\Support\TestCase;

/**
 * Class ArrayHasherTest
 *
 * @package Tests\Chromabits\Structures\Map\Hashers
 */
class ArrayHasherTest extends TestCase
{
    public function testConstructor()
    {
        $hasher = new ArrayHasher();

        $this->assertInstanceOf('Chromabits\Structures\Map\Hashers\ArrayHasher', $hasher);
        $this->assertInstanceOf('Chromabits\Structures\Map\Interfaces\HasherInterface', $hasher);
    }

    public function testHash()
    {
        $hasher = new ArrayHasher();

        $sampleOne = [
            'abcd123' => '45365',
            'kfhgkd' => 95324
        ];

        $sampleTwo = [
            543 => 'blah',
            'lol' => 'boo'
        ];

        $resultOne = $hasher->hash($sampleOne);
        $resultTwo = $hasher->hash($sampleTwo);

        $this->assertNotEquals($resultOne, $resultTwo);
        $this->assertTrue(is_numeric($resultOne));
        $this->assertTrue(is_numeric($resultTwo));
    }
}
