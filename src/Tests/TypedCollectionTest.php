<?php

namespace ShooglyPeg\Tests;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Exceptions\InvalidTypeForCollection;
use ShooglyPeg\TypedCollection;

final class TypedCollectionTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiates(): void
    {
        $collection = new TestNames(array_map(fn (int $i) => new TestName("test name {$i}"), [1, 2, 3, 4]));
        $this->assertInstanceOf(TypedCollection::class, $collection);
        $this->assertCount(4, $collection);

        $this->assertEquals(
            [new TestName('test name 2')],
            $collection->filter(fn (TestName $name) => (string) $name === 'test name 2')
        );

        $this->assertEquals(
            ['test--name--1', 'test--name--2', 'test--name--3', 'test--name--4'],
            $collection->map(fn (TestName $name) => $name->slug())
        );

        $this->assertEquals(
            ['test--name--1', 'test--name--2', 'test--name--3'],
            $collection->reduce(function (?array $out, TestName $name) {
                if (!str_contains((string) $name, '4')) {
                    $out[] = $name->slug();
                }

                return $out;
            })
        );

        $this->assertEquals(
            new TestName('test name 2'),
            $collection->find(fn (TestName $name) => (string) $name === 'test name 2')
        );

        $this->assertEquals(
            json_encode(array_map(fn (int $i) => new TestName("test name {$i}"), [1, 2, 3, 4])),
            json_encode($collection)
        );
    }

    /**
     * @return void
     */
    public function testCanIterateOverCollection(): void
    {
        $collection = new TestNames(array_map(fn (int $i) => new TestName("test name {$i}"), [1, 2, 3, 4]));
        $count = 0;
        $last = null;

        foreach ($collection as $name) {
            ++$count;
            $last = $name;
        }

        $this->assertEquals(4, $count);
        $this->assertEquals(new TestName('test name 4'), $last);
    }

    /**
     * @return void
     */
    public function testExceptionInvalidType(): void
    {
        $this->expectException(InvalidTypeForCollection::class);
        $this->expectExceptionMessage('Object should be ShooglyPeg\Tests\TestName.');

        new TestNames([1, 2, 3]);
    }
}
