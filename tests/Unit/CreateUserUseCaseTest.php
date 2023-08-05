<?php

namespace Tests\Unit;

use App\Adapters\Presenters\User\CreateUserHttpPresenter;
use App\Domain\Interfaces\UserEntity;
use App\Domain\Interfaces\UserFactory;
use App\Domain\Interfaces\UserRepository;
use App\Domain\UseCases\CreateUser\CreateUserInteractor;
use App\Domain\UseCases\CreateUser\CreateUserOutputPort;
use App\Domain\UseCases\CreateUser\CreateUserRequestModel;
use Tests\ProviderUser;
use Tests\TestCase;
use App\Models\User;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\DataProvider;

class CreateUserUseCaseTest extends TestCase
{
    use ProviderUser;

    #[DataProvider('userDataProvider')]
    public function test_user_interactor(array $data)
    {
        (new CreateUserInteractor(
            $this->mockCreateUserPresenter($responseModel),
            $this->mockUserRepository(exists: false),
            $this->mockUserFactory($this->mockUserEntity($data))
        ))->createUser(
            $this->mockRequestModel($data)
        );

        $this->assertUserCreated($data, $responseModel->getUser());
    }

    private function mockUserEntity(array $data): UserEntity
    {
        return tap($this->mock(UserEntity::class), function (MockInterface $mock) use ($data) {
            $mock
                ->shouldReceive('getName')
                ->andReturn($data['user_name']);

            $mock
                ->shouldReceive('getEmail')
                ->andReturn($data['user_email']);
        });
    }

    /** 
     * Mocks a UserFactory object that creates the specified user.
     * 
     * @param User $user The user to be created by the mock UserFactory object.
     * @return UserFactory A mock UserFactory object.
    */
    private function mockUserFactory(UserEntity $user): UserFactory
    {
        return tap($this->mock(UserFactory::class), function (MockInterface $mock) use ($user) {
            $mock
                ->shouldReceive('make')
                ->with(Mockery::type('array'))
                ->andReturn($user);
        });
    }

    /**
     * Mocks a UserRepository object with the specified existsUser return value.
     *
     * @param bool $exists Whether the user exists or not.
     * @return UserRepository A mock UserRepository object.
     */
    private function mockUserRepository(bool $exists = false): UserRepository
    {
        return tap($this->mock(UserRepository::class), function (MockInterface $mock) use ($exists) {
            $mock
                ->shouldReceive('createUser')
                ->with(UserEntity::class)
                ->andReturnUsing(fn ($user) => $user);

            $mock
                ->shouldReceive('existsUser')
                ->andReturn($exists);
        });
    }

    private function mockCreateUserPresenter(&$responseModel): CreateUserOutputPort
    {
        return tap($this->mock(CreateUserHttpPresenter::class), function (MockInterface $mock) use (&$responseModel) {
            $mock
                ->shouldReceive('userCreated')
                ->with(Mockery::capture($responseModel));
        });
    }

    private function mockRequestModel(array $data): CreateUserRequestModel
    {
        return tap($this->mock(CreateUserRequestModel::class), function (MockInterface $mock) use ($data) {
            $mock
                ->shouldReceive('getName')
                ->andReturn($data['user_name']);

            $mock
                ->shouldReceive('getEmail')
                ->andReturn($data['user_email']);
            
            $mock
                ->shouldReceive('getPassword')
                ->andReturn($data['user_password']);
        });
    }
}
