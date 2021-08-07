<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use ShooglyPeg\Domain\Exceptions\InvalidPassword;
use ShooglyPeg\Domain\PasswordHash;

abstract class Password
{
    private const LOWER = 'abcdefghjkmnpqrstuvwxyz';
    private const UPPER = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    private const DIGIT = '23456789';
    private const PUNCT = '!@#$%&*?';

    private const POOL = [
        self::LOWER,
        self::UPPER,
        self::DIGIT,
        self::PUNCT,
    ];

    /**
     * @var string
     */
    private string $content;

    /**
     * @var array
     */
    private array $errors;

    /**
     * @param string $content
     * @throws InvalidPassword
     */
    public function __construct(string $content)
    {
        $this->errors = [];

        $this->checkLength($content);
        $this->checkUpperCase($content);
        $this->checkLowerCase($content);
        $this->checkSpecialCase($content);

        if ($this->errors) {
            throw new InvalidPassword(implode(', ', $this->errors));
        }

        $this->content = $content;
    }

    /**
     * @return string
     */
    public function plain(): string
    {
        return $this->content;
    }

    /**
     * @return PasswordHash
     */
    public function hash(): PasswordHash
    {
        return new PasswordHash((string) password_hash($this->content, PASSWORD_BCRYPT, ['cost' => 10]));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->hash();
    }

    /**
     * @param string $content
     * @return void
     */
    private function checkLength(string $content): void
    {
        if (strlen($content) < 8) {
            $this->errors[] = 'Password must be at least 8 characters long';
        }
    }

    /**
     * @param string $content
     * @return void
     */
    private function checkUpperCase(string $content): void
    {
        if (strtolower($content) === $content) {
            $this->errors[] = 'Password must contain at least 1 uppercase character';
        }
    }

    /**
     * @param string $content
     * @return void
     */
    private function checkLowerCase(string $content): void
    {
        if (strtoupper($content) === $content) {
            $this->errors[] = 'Password must contain at least 1 lowercase character';
        }
    }

    /**
     * @param string $content
     * @return void
     */
    private function checkSpecialCase(string $content): void
    {
        if (strlen(preg_replace("/[A-Za-z]/", '', $content)) === 0) {
            $this->errors[] = 'Password must contain at least 1 special character';
        }
    }

    /**
     * @param int $length
     * @return static
     */
    public static function generate(int $length = 10): static
    {
        // one of each first
        $out = array_map(function ($chars) {
            return $chars[rand(0, strlen($chars) - 1)];
        }, self::POOL);

        $all = implode('', self::POOL);

        for ($i = count($out); $i < $length; ++$i) {
            $out[] = $all[rand(0, strlen($all) - 1)];
        }

        shuffle($out);

        return new static(implode('', $out));
    }
}
