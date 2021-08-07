<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use ShooglyPeg\Domain\Exceptions\InvalidEmail;
use ShooglyPeg\Domain\StringValue;

abstract class Email extends StringValue
{
    /**
     * @param string $value
     * @throws InvalidEmail
     */
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmail::fromValue($value);
        }

        $this->value = $value;
    }
}
