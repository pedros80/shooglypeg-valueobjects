<?php

namespace ShooglyPeg\Tests;

use ShooglyPeg\TypedCollection;
use ShooglyPeg\Tests\TestName;

final class TestNames extends TypedCollection
{
    /**
     * @var string
     */
    protected string $type = TestName::class;
}
