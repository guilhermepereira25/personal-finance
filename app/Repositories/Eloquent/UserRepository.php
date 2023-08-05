<?php

namespace App\Repositories\Eloquent;

use App\Domain\Interfaces\UserEntity;
use App\Models\User;
use App\Domain\Interfaces\UserRepository as UserRepositoryInterface;
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

    public function createUser(UserEntity $user): UserEntity
    {
        return $this->model::create([
            'user_name' => $user->getName(),
            'user_email' => $user->getEmail(),
            'user_password' => $user->getPassword(),
        ]);
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