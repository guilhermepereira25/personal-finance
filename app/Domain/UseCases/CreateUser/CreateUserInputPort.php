<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\ViewModel;

interface CreateUserInputPort
{
    public function createUser(CreateUserRequestModel $request): ViewModel;
}