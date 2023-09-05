<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RegisteredUserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Interfaces\UserFactory::class,
            \App\Factories\UserModelFactory::class
        );

        $this->app->bind(
            Domain\Interfaces\UserRepository::class,
            \App\Repositories\Eloquent\UserRepository::class
        );

        $this->app
            ->when(\App\Http\Controllers\Auth\RegisteredUserController::class)
            ->needs(\App\Domain\UseCases\RegisteredUser\RegisteredUserInputPort::class)
            ->give(function (Application $app) {
                return $app->make(\App\Domain\UseCases\RegisteredUser\RegisteredUserInteractor::class, [
                    'outputPort' => $app->make(\App\Adapters\Presenters\RegisteredUser\RegisteredUserHttpPresenter::class),
                    'userFactory' => $app->make(\App\Domain\Interfaces\UserFactory::class),
                    'userRepository' => $app->make(\App\Domain\Interfaces\UserRepository::class),
                ]);
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
