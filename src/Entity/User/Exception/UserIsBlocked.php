<?php

declare(strict_types=1);

namespace App\Entity\User\Exception;

final class UserIsBlocked extends \InvalidArgumentException
{
    public static function create(): UserIsBlocked
    {
        return new self('User login has more than three consecutive fails.');
    }
}
