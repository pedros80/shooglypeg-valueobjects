<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain\Exceptions;

use Exception;

final class InvalidLongitude extends Exception
{
    /**
     * @param string $message
     */
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    /**
     * @param float $value
     * @return InvalidLongitude
     */
    public static function fromValue(float $value): InvalidLongitude
    {
        return new InvalidLongitude("{$value} is not a valid longitude. Must be between -180 and 180");
    }
}
