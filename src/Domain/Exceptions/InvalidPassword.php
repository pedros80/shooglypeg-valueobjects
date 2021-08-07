<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain\Exceptions;

use Exception;

final class InvalidPassword extends Exception
{
    public function __construct(string $error)
    {
        parent::__construct("Error: {$error}", 400);
    }
}
