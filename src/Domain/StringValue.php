<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use JsonSerializable;

abstract class StringValue implements JsonSerializable
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return (string) $this;
    }
}
