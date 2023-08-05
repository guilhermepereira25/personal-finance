<?php

namespace App\Domain\Interfaces;

use App\Domain\Interfaces\UserEntity;

interface UserFactory
{
    /**
     * @param array<mixed> $attributes
     */
    public function make(array $attributes = []): UserEntity;
}