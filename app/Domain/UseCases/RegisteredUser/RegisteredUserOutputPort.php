<?php

namespace App\Domain\UseCases\RegisteredUser;

use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\RegisteredUser\RegisteredUserResponseModel;

interface RegisteredUserOutputPort
{
    public function userRegistered(RegisteredUserResponseModel $response): ViewModel;

    public function userNotRegistered(RegisteredUserResponseModel $response): ViewModel;

    public function userAlreadyExists(RegisteredUserResponseModel $response): ViewModel;
}