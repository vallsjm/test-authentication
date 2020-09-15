<?php

declare(strict_types=1);

namespace Tests\App\Service;

use Tests\App\Service\LoginCase;
use App\Entity\User\Exception\UserNotFound;
use App\Entity\User\Exception\PasswordInvalidLength;
use App\Entity\User\Exception\PasswordNotContainsNumber;
use App\Entity\User\Exception\PasswordNotContainsSpecialChar;

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

}
