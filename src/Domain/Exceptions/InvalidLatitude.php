<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain\Exceptions;

use Exception;

final class InvalidLatitude extends Exception
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
     * @return InvalidLatitude
     */
    public static function fromValue(float $value): InvalidLatitude
    {
        return new InvalidLatitude("{$value} is not a valid longitude. Must be between -90 and 90");
    }
}
