<?php

declare(strict_types=1);

namespace Tests\App\Service;

use PHPUnit\Framework\TestCase;
use App\Entity\User\UserRepository;
use App\Service\Authentication;
use App\Service\Login;

class LoginCase extends TestCase
{
    protected $login;

    public function setUp(): void
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->method('findByEmail')
                     ->willReturn(null);

        $auth = new Authentication();
        $this->login = new Login($userRepositoryMock, $auth);
    }

}
