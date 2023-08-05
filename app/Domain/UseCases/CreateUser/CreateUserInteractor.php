<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\UserFactory;
use App\Domain\Interfaces\UserRepository;
use App\Domain\Interfaces\ViewModel;
use Exception;

class CreateUserInteractor implements CreateUserInputPort
{
    public function __construct(
        private CreateUserOutputPort $outputPort,
        private UserRepository $userRepository,
        private UserFactory $userFactory
    )
    {
    }

    public function createUser(CreateUserRequestModel $request): ViewModel
    {
        $user = $this->userFactory->make([
            'user_name' => $request->getName(),
            'user_email' => $request->getEmail(),
        ]);

        if ($this->userRepository->existsUser($user)) {
            return $this->outputPort->userAlreadyExists(new CreateUserResponseModel($user));
        }

        try {
            $user = $this->userRepository->createUser($user);
        } catch (Exception $e) {
            return $this->outputPort->userNotCreated(new CreateUserResponseModel($user));
        }

        return $this->outputPort->userCreated(new CreateUserResponseModel($user));
    }
}