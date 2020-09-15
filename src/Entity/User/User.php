<?php

declare(strict_types=1);

namespace App\Entity\User;

final class User
{
    private $email;
    private $password;
    private $loginCounter;

    public function __construct(string $email, string $password)
    {
        $this->email        = UserEmail   ::fromString($email);
        $this->password     = UserPassword::fromString($password);
        $this->loginCounter = 0;
    }

    public static function create(string $email, string $password)
    {
        return new self($email, $password);
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function isBlocked(): bool
    {
        return $this->loginCounter >= 3;
    }

    public function incLoginCounter(): void
    {
        $this->loginCounter++;
    }

    public function resetLoginCounter(): void
    {
        $this->loginCounter = 0;
    }
}
