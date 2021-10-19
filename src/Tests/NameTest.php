<?php

namespace ShooglyPeg\Tests;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Name;

final class NameTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiates(): void
    {
        $name = new class('Raith Rovers') extends Name {};
        $dupe = new class('Raith Rovers') extends Name {};
        $diff = new class('Dunfermline Athletic') extends Name {};

        $this->assertInstanceOf(Name::class, $name);
        $this->assertTrue($name->equals($dupe));
        $this->assertFalse($name->equals($diff));
        $this->assertEquals('raith--rovers', $name->slug());
    }

    /**
     * @return void
     */
    public function testFromSlug(): void
    {
        $name = TestName::fromSlug('raith--rovers');

        $this->assertInstanceOf(Name::class, $name);
        $this->assertEquals('Raith Rovers', (string) $name);
    }
}
