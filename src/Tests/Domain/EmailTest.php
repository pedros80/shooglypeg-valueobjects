<?php

namespace ShooglyPeg\Tests\Domain;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Domain\Email;
use ShooglyPeg\Domain\Exceptions\InvalidEmail;

final class EmailTest extends TestCase
{
    private Email $email;

    /**
     * @return void
     */
    public function testInstantiatesIfEmailIsValid(): void
    {
        $this->email = new class('peterwsomerville@gmail.com') extends Email {};
        $this->assertInstanceOf(Email::class, $this->email);
        $this->assertEquals('peterwsomerville@gmail.com', (string) $this->email);
        $this->assertEquals('"peterwsomerville@gmail.com"', json_encode($this->email));
    }

    /**
     * @return void
     */
    public function testExceptionIfEmailInvalid(): void
    {
        $this->expectException(InvalidEmail::class);
        $this->expectExceptionMessage('jobby is not a valid email address.');

        $this->email = new class('jobby') extends Email {};
    }
}
