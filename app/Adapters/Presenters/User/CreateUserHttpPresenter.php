<?php

namespace App\Adapters\Presenters\User;

use App\Adapters\ViewModels\HttpResponseViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\CreateUser\CreateUserOutputPort;
use App\Domain\UseCases\CreateUser\CreateUserResponseModel;
use Inertia\Inertia;

class CreateUserHttpPresenter implements CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): ViewModel
    {
        return new HttpResponseViewModel(
            Inertia::render(
                'Users/Create',
                [
                    'user' => $model->getUser(),
                ]
        ));
    }

    public function userNotCreated(CreateUserResponseModel $model): ViewModel
    {
        return new HttpResponseViewModel(
            Inertia::render(
                'Users/Create',
                [
                    'user' => $model->getUser(),
                    'errors' => [
                        'user' => 'User not created',
                    ]
                ]
            )
        );
    }

    public function userAlreadyExists(CreateUserResponseModel $model): ViewModel
    {
        return new HttpResponseViewModel(
            Inertia::render(
                'Users/Create',
                [
                    'user' => $model->getUser(),
                    'errors' => [
                        'user' => 'User already exists',
                    ]
                ]
            )
        );
    }
}
