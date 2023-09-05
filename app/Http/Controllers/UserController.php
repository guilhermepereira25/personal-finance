<?php

namespace App\Http\Controllers;

use App\Adapters\ViewModels\HttpResponseViewModel;
use App\Domain\UseCases\CreateUser\CreateUserInputPort;
use App\Domain\UseCases\CreateUser\CreateUserRequestModel;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function __construct(
        private CreateUserInputPort $interactor
    )
    {
    }

    public function store(StoreUserRequest $request)
    {
        $viewModel = $this->interactor->createUser(
            new CreateUserRequestModel($request->validated())
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }
}
