<?php

declare(strict_types=1);

namespace App\Entity\User\Exception;

final class PasswordNotContainsSpecialChar extends \InvalidArgumentException
{
    public static function create(string $specialChars): PasswordNotContainsSpecialChar
    {
        return new self(\sprintf('The password must contain a special char [%s].', $specialChars));
    }
}
