<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain\Exceptions;

use Exception;

final class InvalidEmail extends Exception
{
    /**
     * @param string $message
     */
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    /**
     * @param string $value
     * @return InvalidEmail
     */
    public static function fromValue(string $value): InvalidEmail
    {
        return new InvalidEmail("{$value} is not a valid email address.");
    }
}
