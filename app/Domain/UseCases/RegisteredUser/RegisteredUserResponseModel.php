<?php

namespace App\Domain\UseCases\RegisteredUser;

use App\Domain\Interfaces\UserEntity;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserResponseModel
{
    public function __construct(
        private UserEntity $user
    )
    { 
    }

    public function getUser(): UserEntity
    {
        return $this->user;
    }

    public function login()
    {
        Auth::login($this->user);
    }

    public function registered(): array | null
    {
        return event(new Registered($this->user));
    }
}