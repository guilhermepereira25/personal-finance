<?php

namespace App\Http\Controllers\Auth;

use App\Adapters\ViewModels\HttpResponseViewModel;
use App\Domain\UseCases\RegisteredUser\RegisteredUserInputPort;
use App\Domain\UseCases\RegisteredUser\RegisteredUserRequestModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisteredUserController extends Controller
{
    public function __construct(
        private RegisteredUserInputPort $interactor
    )
    {
    }

    /**
     * Display the registration view.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request): InertiaResponse | Response
    {
        $viewModel = $this->interactor->registeredUser(
            new RegisteredUserRequestModel($request->validated())
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }
}
