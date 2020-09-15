<?php


declare(strict_types=1);

namespace App\Service;

use App\Entity\User\User;
use App\Entity\User\UserPassword;

final class Authentication
{
    public function authenticate(User $user, UserPassword $userPassword): bool
    {
        if ($user->password()->equals($userPassword)) {
            $user->resetLoginCounter();
            return true;
        } else {
            $user->incLoginCounter();
        }
        return false;
    }
}
