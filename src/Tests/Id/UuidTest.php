<?php

namespace ShooglyPeg\Tests\Id;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Id\Id;
use ShooglyPeg\Id\Uuid;

final class UuidTest extends TestCase
{
    public function testInstantiates(): void
    {
        $uuid = new TestUuid('e0ad8428-fdea-4c69-9149-308dba32c390');
        $dupe = new TestUuid('e0ad8428-fdea-4c69-9149-308dba32c390');
        $diff = TestUuid::fromString('da188668-97c8-4f58-9393-4d4548570ad1');

        $this->assertInstanceOf(Id::class, $uuid);
        $this->assertInstanceOf(Uuid::class, $uuid);
        $this->assertEquals('e0ad8428-fdea-4c69-9149-308dba32c390', (string) $uuid);
        $this->assertTrue($uuid->equals($dupe));
        $this->assertFalse($uuid->equals($diff));
        $this->assertEquals('"e0ad8428-fdea-4c69-9149-308dba32c390"', json_encode($uuid));
    }
}