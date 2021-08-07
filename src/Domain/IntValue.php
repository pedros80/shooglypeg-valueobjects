<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use JsonSerializable;

abstract class IntValue implements JsonSerializable
{
    /**
     * @var int
     */
    protected int $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
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
