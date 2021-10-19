<?php

declare(strict_types=1);

namespace ShooglyPeg;

use ShooglyPeg\StringValue;

abstract class Name extends StringValue
{
    /**
     * @param Name $other
     * @return bool
     */
    public function equals(Name $other): bool
    {
        return $this->value === (string) $other;
    }

    /**
     * @return string
     */
    public function slug(): string
    {
        return str_replace([' ', "'"], ['--', '-'], strtolower($this->value));
    }

    /**
     * @param string $slug
     * @return static
     */
    public static function fromSlug(string $slug): self
    {
        return new static(ucwords(str_replace(['--', '-'], [' ', "'"], $slug)));
    }
}
