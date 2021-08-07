<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use JsonSerializable;
use ShooglyPeg\Domain\Exceptions\InvalidEmail;

abstract class Email implements JsonSerializable
{
    /**
     * @var string
     */
    private string $address;

    /**
     * @param string $address
     * @throws InvalidEmail
     */
    public function __construct(string $address)
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmail::fromValue($address);
        }

        $this->address = $address;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return (string) $this;
    }
}
