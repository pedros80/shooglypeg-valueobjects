<?php

declare(strict_types=1);

namespace ShooglyPeg;

use ShooglyPeg\Exceptions\InvalidEmail;
use ShooglyPeg\StringValue;

abstract class Email extends StringValue
{
    /**
     * @param string $value
     * @throws InvalidEmail
     */
    public function __construct(
        protected string $value
    ) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmail::fromValue($value);
        }
    }
}
