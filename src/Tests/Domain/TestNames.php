<?php

namespace ShooglyPeg\Tests\Domain;

use ShooglyPeg\Domain\TypedCollection;
use ShooglyPeg\Tests\Domain\TestName;

final class TestNames extends TypedCollection
{
    /**
     * @var string
     */
    protected string $type = TestName::class;
}
