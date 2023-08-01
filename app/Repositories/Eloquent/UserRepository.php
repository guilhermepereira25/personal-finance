<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor
     * 
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function createUser(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function findUser(string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function whereUser(array $attributes): ?Collection
    {
        return $this->model->where($attributes);
    }
}