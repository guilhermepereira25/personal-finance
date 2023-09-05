<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\CreateUser\CreateUserResponseModel;

interface CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $response): ViewModel;

    public function userNotCreated(CreateUserResponseModel $response): ViewModel;

    public function userAlreadyExists(CreateUserResponseModel $response): ViewModel;
}