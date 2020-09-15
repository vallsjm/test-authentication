<?php

declare(strict_types=1);

namespace App\Entity\User\Exception;

final class PasswordInvalidLength extends \InvalidArgumentException
{
    public static function create(int $minValue, int $maxValue): PasswordInvalidLength
    {
        return new self(\sprintf('The pasword length must be between %d and %d characters.', $minValue, $maxValue));
    }
}
