<?php

declare(strict_types=1);

namespace App\Entity\User\Exception;

final class UserNotFound extends \InvalidArgumentException
{
    public static function create(string $email): UserNotFound
    {
        return new self(\sprintf('User with email %s don\'t found.', $email));
    }
}
