<?php

namespace ShooglyPeg\Tests\Domain;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Domain\Exceptions\InvalidPassword;
use ShooglyPeg\Domain\Password;
use ShooglyPeg\Domain\PasswordHash;
use ShooglyPeg\Tests\Domain\TestPassword;

/**
 * @group Password
 */
final class PasswordTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiates(): void
    {
        $password = new class('PassWord1') extends Password {};

        $this->assertInstanceOf(Password::class, $password);
    }

    /**
     * @return void
     */
    public function testTooShort(): void
    {
        $this->expectException(InvalidPassword::class);
        $this->expectExceptionMessage('Error: Password must be at least 8 characters long');

        new class('PassW1') extends Password {};
    }

    /**
     * @return void
     */
    public function testNoLower(): void
    {
        $this->expectException(InvalidPassword::class);
        $this->expectExceptionMessage('Error: Password must contain at least 1 lowercase character');

        new class('PASSWORD1') extends Password {};
    }

    /**
     * @return void
     */
    public function testNoUpper(): void
    {
        $this->expectException(InvalidPassword::class);
        $this->expectExceptionMessage('Error: Password must contain at least 1 uppercase character');

        new class('password1') extends Password {};
    }

    /**
     * @return void
     */
    public function testNoSpecial(): void
    {
        $this->expectException(InvalidPassword::class);
        $this->expectExceptionMessage('Error: Password must contain at least 1 special character');

        new class('Password') extends Password {};
    }

    /**
     * @return void
     */
    public function testNoMultiple(): void
    {
        $message = 'Error: Password must contain at least 1 uppercase character, ' .
            'Password must contain at least 1 lowercase character';
        $this->expectException(InvalidPassword::class);
        $this->expectExceptionMessage($message);

        new class('12345678') extends Password {};
    }

    /**
     * @return void
     */
    public function testCrypt(): void
    {
        $password = new class('PassWord1') extends Password {};

        $this->assertTrue(password_verify('PassWord1', (string) $password));
    }

    /**
     * @return void
     */
    public function testPlain(): void
    {
        $password = new class('PassWord1') extends Password {};

        $this->assertEquals('PassWord1', $password->plain());
    }

    /**
     * @return void
     */
    public function testHash(): void
    {
        $password = new class('PassWord1') extends Password {};

        $this->assertInstanceOf(PasswordHash::class, $password->hash());
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $password = TestPassword::generate();
        $this->assertInstanceOf(TestPassword::class, $password);
    }
}
