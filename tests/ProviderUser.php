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
                    'name' => fake()->name(),
                    'email' => fake()->email(),
                    'password' => fake()->password(8)
                ]
            ]
        ];
    }

    public function assertUserCreated(array $data, UserEntity $user)
    {
        $this->assertEquals($user->getName(), $data['name']);
        $this->assertEquals($user->getEmail(), $data['email']);
    }
}