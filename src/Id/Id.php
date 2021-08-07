<?php

declare(strict_types=1);

namespace ShooglyPeg\Id;

use JsonSerializable;

abstract class Id implements JsonSerializable
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param Id $other
     * @return bool
     */
    public function equals(Id $other): bool
    {
        return $this->value === (string) $other;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return (string) $this;
    }

    /**
     * @param string $value
     * @return static
     */
    public static function fromString(string $value): self
    {
        return new static($value);
    }
}
