<?php

declare(strict_types=1);

namespace App\Entity\User;

use Common\Domain\ValueObject\String\BaseString;
use App\Entity\User\Exception\PasswordInvalidLength;
use App\Entity\User\Exception\PasswordNotContainsNumber;
use App\Entity\User\Exception\PasswordNotContainsSpecialChar;
use Assert\Assertion;

final class UserPassword extends BaseString
{
    public function validate(string $value): void
    {
        try {
            Assertion::minLength($value, 6);
            Assertion::maxLength($value, 10);
        } catch (\Exception $e) {
            throw PasswordInvalidLength::create(6, 10);
        }
        if (!preg_match('@[0-9]@', $value)) {
            throw PasswordNotContainsNumber::create();
        }
        if (!preg_match('@[\!\^\`\ç\$]@', $value)) {
            throw PasswordNotContainsSpecialChar::create('!^`ç$');
        }
    }
}
