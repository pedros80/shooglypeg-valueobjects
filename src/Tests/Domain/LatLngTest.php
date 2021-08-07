<?php

namespace ShooglyPeg\Tests\Domain;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Domain\Exceptions\InvalidLatitude;
use ShooglyPeg\Domain\Exceptions\InvalidLongitude;
use ShooglyPeg\Domain\LatLng;

final class LatLngTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiates(): void
    {
        $location = LatLng::fromString('56.001, 3.0000001');

        $this->assertInstanceOf(LatLng::class, $location);
        $this->assertEquals('56.001, 3.0000001', (string) $location);
        $this->assertEquals('56.001', $location->lat());
        $this->assertEquals('3.0000001', $location->lng());
        $this->assertEquals([
            'lat' => '56.001',
            'lng' => '3.0000001'
        ], $location->toArray());
        $this->assertEquals('"56.001, 3.0000001"', json_encode($location));
    }

    /**
     * @return void
     */
    public function testInvalidLatTooSmall(): void
    {
        $this->expectException(InvalidLatitude::class);
        $this->expectExceptionMessage('-100 is not a valid longitude. Must be between -90 and 90');

        LatLng::fromString('-100, -100');
    }

    /**
     * @return void
     */
    public function testInvalidLatTooLarge(): void
    {
        $this->expectException(InvalidLatitude::class);
        $this->expectExceptionMessage('156 is not a valid longitude. Must be between -90 and 90');

        LatLng::fromString('156, -100');
    }

    /**
     * @return void
     */
    public function testInvalidLngTooSmall(): void
    {
        $this->expectException(InvalidLongitude::class);
        $this->expectExceptionMessage('-200 is not a valid longitude. Must be between -180 and 180');

        LatLng::fromString('75, -200');
    }

    /**
     * @return void
     */
    public function testInvalidLngTooLarge(): void
    {
        $this->expectException(InvalidLongitude::class);
        $this->expectExceptionMessage('200 is not a valid longitude. Must be between -180 and 180');

        LatLng::fromString('75, 200');
    }
}
