<?php

declare(strict_types=1);

namespace ShooglyPeg;

use JsonSerializable;
use ShooglyPeg\Exceptions\InvalidLatitude;
use ShooglyPeg\Exceptions\InvalidLongitude;

final class LatLng implements JsonSerializable
{
    /**
     * @param float $lat
     * @param float $lng
     * @throws InvalidLatitude
     * @throws InvalidLongitude
     */
    public function __construct(
        private float $lat,
        private float $lng)
    {
        if ($lat < -90 || $lat > 90) {
            throw InvalidLatitude::fromValue($lat);
        }

        if ($lng < -180 || $lng > 180) {
            throw InvalidLongitude::fromValue($lng);
        }
    }

    /**
     * @return string
     */
    public function lat(): string
    {
        return (string) $this->lat;
    }

    /**
     * @return string
     */
    public function lng(): string
    {
        return (string) $this->lng;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'lat' => $this->lat(),
            'lng' => $this->lng(),
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(', ', $this->toArray());
    }

    /**
     * @param string $location
     * @return LatLng
     */
    public static function fromString(string $location): LatLng
    {
        $location = explode(', ', $location);

        return new LatLng((float) $location[0], (float) $location[1]);
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return (string) $this;
    }
}
