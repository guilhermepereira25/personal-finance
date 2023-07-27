<?php

namespace App\Repository\Eloquent;

use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return $this->model->all();
    }
}