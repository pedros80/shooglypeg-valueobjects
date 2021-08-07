<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use ShooglyPeg\Domain\Exceptions\InvalidCurrency;

final class Currency extends StringValue
{
    public const VALID = [
        'GBP' => '£',
    ];

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!in_array($value, array_keys(self::VALID))) {
            throw InvalidCurrency::fromString($value);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function symbol(): string
    {
        return self::VALID[$this->value];
    }
}
