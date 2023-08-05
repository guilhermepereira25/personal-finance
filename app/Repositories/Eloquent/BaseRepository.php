<?php

namespace App\Repositories\Eloquent;

use App\Domain\Interfaces\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepository
{
    /**
     * BaseRepository constructor
     * 
     * @param Model $model
     */
    public function __construct(
        protected Model $model
    )
    {
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find(mixed $id): Collection
    {
        return $this->model->find($id);
    }

    public function where(array $attributes): Collection
    {
        return $this->model->where($attributes)->get();
    }
}