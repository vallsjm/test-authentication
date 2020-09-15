<?php


declare(strict_types=1);

namespace App\Service;

use App\Entity\User\UserRepository;
use App\Entity\User\UserPassword;
use App\Entity\User\Exception\UserNotFound;
use App\Entity\User\Exception\UserIsBlocked;

final class Login
{
    private $userRepository;
    private $auth;

    public function __construct(
        UserRepository $userRepository,
        Authentication $auth
    )
    {
        $this->userRepository = $userRepository;
        $this->auth           = $auth;
    }

    public function __invoke(string $email, string $password): bool
    {
        $userPassword = UserPassword::fromString($password);
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw UserNotFound::create($email);
        }
        if ($user->isBlocked()) {
            throw UserIsBlocked::create();
        }

        return $this->authenticate($user, $userPassword);
    }
}
