<?php

declare(strict_types=1);

namespace ShooglyPeg\Id;

use Assert\Assertion;
use ShooglyPeg\Id\Id;

abstract class Uuid extends Id
{
    /**
     * @param string $value
     */
    public function __construct(
        protected string $value
    ) {
        Assertion::uuid($value);
    }
}
