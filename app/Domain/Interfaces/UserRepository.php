<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepository
{
    public function all(): Collection;

    public function createUser(UserEntity $user): UserEntity;

    public function findUser(string $id): ?Model;

    public function whereUser(array $attributes): ?Collection;

    public function existsUser(UserEntity $user): bool;
}