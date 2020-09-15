<?php

declare(strict_types=1);

namespace Tests\App\Service;

use Tests\App\Service\LoginCase;
use App\Entity\User\Exception\UserNotFound;
use App\Entity\User\Exception\UserIsBlocked;
use App\Entity\User\Exception\PasswordInvalidLength;
use App\Entity\User\Exception\PasswordNotContainsNumber;
use App\Entity\User\Exception\PasswordNotContainsSpecialChar;
use App\Entity\User\User;
use App\Entity\User\UserRepository;
use App\Service\Authentication;
use App\Service\Login;

final class LoginTest extends LoginCase
{
    public function testPaswordInvalidMinLength()
    {
        $this->expectException(PasswordInvalidLength::class);
        ($this->login)('chema@elcurriculum.com', '4');
    }

    public function testPaswordInvalidMaxLength()
    {
        $this->expectException(PasswordInvalidLength::class);
        ($this->login)('chema@elcurriculum.com', '4444444444444');
    }

    public function testPasswordNotContainsNumber()
    {
        $this->expectException(PasswordNotContainsNumber::class);
        ($this->login)('chema@elcurriculum.com', 'josemola');
    }

    public function testPasswordNotContainsSpecialChar()
    {
        $this->expectException(PasswordNotContainsSpecialChar::class);
        ($this->login)('chema@elcurriculum.com', 'j0semola');
    }

    public function testUserNotFound()
    {
        $this->expectException(UserNotFound::class);
        ($this->login)('chema@elcurriculum.com', 'j0sem^la');
    }

    public function testUserIsBlocked()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->method('findByEmail')
                     ->willReturn(User::create('chema@elcurriculum.com', 'j0sem^la'));

        $auth = new Authentication();
        $login = new Login($userRepositoryMock, $auth);
        $login('chema@elcurriculum.com', 'j0sem^la1');
        $login('chema@elcurriculum.com', 'j0sem^la2');
        $login('chema@elcurriculum.com', 'j0sem^la3');
        $this->expectException(UserIsBlocked::class);
        $login('chema@elcurriculum.com', 'j0sem^la');
    }

    public function testLoginSuccess()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->method('findByEmail')
                     ->willReturn(User::create('chema@elcurriculum.com', 'j0sem^la'));

        $auth = new Authentication();
        $login = new Login($userRepositoryMock, $auth);
        $this->assertTrue($login('chema@elcurriculum.com', 'j0sem^la'));
    }

}
