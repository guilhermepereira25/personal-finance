<?php

namespace App\Domain\UseCases\RegisteredUser;

use App\Domain\Interfaces\UserFactory;
use App\Domain\UseCases\RegisteredUser\RegisteredUserInputPort;
use App\Domain\UseCases\RegisteredUser\RegisteredUserOutputPort;
use App\Domain\Interfaces\UserRepository;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\RegisteredUser\RegisteredUserRequestModel;
use Exception;

class RegisteredUserInteractor implements RegisteredUserInputPort
{
    public function __construct(
        private RegisteredUserOutputPort $outputPort,
        private UserFactory $userFactory,
        private UserRepository $userRepository
    ) 
    {
    }

    public function registeredUser(RegisteredUserRequestModel $request): ViewModel
    {
        $user = $this->userFactory->make([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);

        if ($this->userRepository->existsUser($user)) {
            return $this->outputPort->userAlreadyExists(new RegisteredUserResponseModel($user));
        }

        try {
            $user = $this->userRepository->createUser($user);
        } catch (Exception $exception) {
            return $this->outputPort->userNotRegistered(new RegisteredUserResponseModel($user));
        }

        return $this->outputPort->userRegistered(new RegisteredUserResponseModel($user));
    }
}