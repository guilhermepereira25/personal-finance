<?php

namespace App\Domain\UseCases\RegisteredUser;

use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\RegisteredUser\RegisteredUserRequestModel;

interface RegisteredUserInputPort
{
    public function registeredUser(RegisteredUserRequestModel $request): ViewModel;
}