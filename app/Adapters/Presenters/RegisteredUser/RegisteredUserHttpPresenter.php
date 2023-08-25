<?php

namespace App\Adapters\Presenters\RegisteredUser;

use App\Adapters\ViewModels\HttpResponseViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\RegisteredUser\RegisteredUserOutputPort;
use App\Domain\UseCases\RegisteredUser\RegisteredUserResponseModel;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class RegisteredUserHttpPresenter implements RegisteredUserOutputPort
{
    public function userRegistered(RegisteredUserResponseModel $response): ViewModel
    {
        $response->registered();
        $response->login();

        return new HttpResponseViewModel(
            to_route(RouteServiceProvider::HOME)
        );
    }

    public function userNotRegistered(RegisteredUserResponseModel $response): ViewModel
    {
        return new HttpResponseViewModel(
            Inertia::render(
                'Auth/Register',
                [
                    'errors' => [
                        'messagae' => 'Error registering user',
                    ]
                ]
            )
        );
    }

    public function userAlreadyExists(RegisteredUserResponseModel $response): ViewModel
    {
        return new HttpResponseViewModel(
            Inertia::render('Auth/Login')
        );
    }
}