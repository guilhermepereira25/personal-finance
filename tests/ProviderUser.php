<?php

namespace Tests;

use App\Domain\Interfaces\UserEntity;
use App\Models\User;

trait ProviderUser 
{
    public function userDataProvider(): array
    {
        return [
            [
                [
                    'user_name' => fake()->name(),
                    'user_email' => fake()->email(),
                    'user_password' => fake()->password()
                ]
            ]
        ];
    }

    public function assertUserCreated(array $data, UserEntity $user)
    {
        $this->assertEquals($user->getName(), $data['user_name']);
        $this->assertEquals($user->getEmail(), $data['user_email']);
    }
}