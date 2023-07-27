<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes): Model;

    /**
     * @param mixed $id
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function find(mixed $id): Collection;
}