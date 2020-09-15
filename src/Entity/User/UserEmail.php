<?php

declare(strict_types=1);

namespace App\Entity\User;

use Common\Domain\ValueObject\Email\BaseEmail;
use Assert\Assertion;

final class UserEmail extends BaseEmail
{
    public function validate(string $value): void
    {
        try {
            Assertion::email($value);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("El email '{$value}' no es valido");
        }
    }
}
