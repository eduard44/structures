<?php

namespace Tests\Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Hashers\NaiveStringHasher;
use Tests\Chromabits\Support\TestCase;

/**
 * Class NaiveStringHasherTest
 *
 * @package Tests\Chromabits\Structures\Map\Hashers
 */
class NaiveStringHasherTest extends TestCase
{
    public function testHash()
    {
        $hasher = new NaiveStringHasher();

        $resultOne = $hasher->hash('hello123');
        $resultTwo = $hasher->hash('worlds1234!');

        $this->assertNotEquals($resultOne, $resultTwo);
        $this->assertTrue(is_numeric($resultOne));
        $this->assertTrue(is_numeric($resultTwo));
    }
}
