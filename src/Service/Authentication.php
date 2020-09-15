<?php


declare(strict_types=1);

namespace App\Service;

final class Authentication
{
    public function authenticate(User $user, UserPassword $userPassword): bool
    {
        if ($user->password()->equals($userPassword)) {
            $user->resetLoginCounter();
            return true;
        } else {
            $user->incrementLoginCounter();
        }
        return false;
    }
}
