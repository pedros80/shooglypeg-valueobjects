<?php

namespace ShooglyPeg\Tests\Domain;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Domain\IntValue;
use ShooglyPeg\Tests\Domain\TestInt;

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