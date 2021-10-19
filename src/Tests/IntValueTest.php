<?php

namespace ShooglyPeg\Tests;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\IntValue;
use ShooglyPeg\Tests\TestInt;

final class IntValueTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiates(): void
    {
        $int = new TestInt(1);

        $this->assertInstanceOf(IntValue::class, $int);
        $this->assertEquals(1, $int->value());
        $this->assertEquals('1', (string) $int);
        $this->assertEquals('1', json_encode($int));
    }
}