<?php

declare(strict_types=1);

namespace App\Entity\User\Exception;

final class PasswordNotContainsNumber extends \InvalidArgumentException
{
    public static function create(): PasswordNotContainsNumber
    {
        return new self('The password must contain a numeric char.');
    }
}
