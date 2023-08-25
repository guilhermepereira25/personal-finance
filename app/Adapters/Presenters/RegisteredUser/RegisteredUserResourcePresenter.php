<?php

namespace App\Adapters\Presenters\RegisteredUser;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\RegisteredUser\RegisteredUserOutputPort;
use App\Domain\UseCases\RegisteredUser\RegisteredUserResponseModel;
use App\Http\Resources\RegisteredUserResource;

class RegisteredUserResourcePresenter implements RegisteredUserOutputPort
{
    public function userRegistered(RegisteredUserResponseModel $model): ViewModel
    {
        return new JsonResourceViewModel(
            new RegisteredUserResource($model->getUser())
        );
    }

    public function userNotRegistered(): ViewModel
    {
        //
    }

    public function userAlreadyExists(): ViewModel
    {
        //
    }
}