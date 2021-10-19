<?php

declare(strict_types=1);

namespace ShooglyPeg;

use JsonSerializable;

abstract class StringValue implements JsonSerializable
{
    /**
     * @param string $value
     */
    public function __construct(
        protected string $value
    ) {
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
