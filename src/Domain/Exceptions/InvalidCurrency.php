<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain\Exceptions;

use Exception;

final class InvalidCurrency extends Exception
{
    /**
     * @param string $message
     */
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    /**
     * @param string $currency
     * @return InvalidCurrency
     */
    public static function fromString(string $currency): InvalidCurrency
    {
        return new InvalidCurrency("{$currency} is not a valid currency.");
    }
}
