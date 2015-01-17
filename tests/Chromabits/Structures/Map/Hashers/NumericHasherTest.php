<?php

namespace Tests\Chromabits\Structures\Map\Hashers;

use Chromabits\Structures\Map\Hashers\NumericHasher;
use Tests\Chromabits\Support\TestCase;

/**
 * Class NumericHasherTest
 *
 * @package Tests\Chromabits\Structures\Map\Hashers
 */
class NumericHasherTest extends TestCase
{
    public function testHash()
    {
        $hasher = new NumericHasher();

        $resultOne = $hasher->hash(12345);
        $resultTwo = $hasher->hash(456.56);

        $this->assertNotEquals($resultOne, $resultTwo);
        $this->assertTrue(is_numeric($resultOne));
        $this->assertTrue(is_numeric($resultTwo));
    }
}
