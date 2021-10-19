<?php

declare(strict_types=1);

namespace ShooglyPeg;

use JsonSerializable;

abstract class IntValue implements JsonSerializable
{
    /**
     * @param int $value
     */
    public function __construct(
        protected int $value
    ) {
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value();
    }

    /**
     * @return int
     */
    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
