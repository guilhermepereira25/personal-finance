<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function createUser(array $attributes): Model;

    public function findUser(string $id): ?Model;

    public function whereUser(array $attributes): ?Collection;
}