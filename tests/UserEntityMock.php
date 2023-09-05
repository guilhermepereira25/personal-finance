<?php

namespace Tests;

use App\Domain\Interfaces\UserEntity;
use Mockery;
use Mockery\LegacyMockInterface;

trait UserEntityMock
{
    public function mockUserEntity(array $data): UserEntity
    {
        return tap(Mockery::mock(UserEntity::class), function (LegacyMockInterface $mock) use ($data) {
            $mock
                ->shouldReceive('getName')
                ->andReturn($data['name']);

            $mock
                ->shouldReceive('getEmail')
                ->andReturn($data['email']);
        });
    }
}