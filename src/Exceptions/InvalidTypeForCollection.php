<?php

declare(strict_types=1);

namespace ShooglyPeg\Exceptions;

use Exception;

final class InvalidTypeForCollection extends Exception
{
    /**
     * @param string $message
     */
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    /**
     * @param string $fqcn
     * @return InvalidTypeForCollection
     */
    public static function fromClass(string $fqcn): InvalidTypeForCollection
    {
        return new InvalidTypeForCollection("Object should be {$fqcn}.");
    }
}
