<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            Domain\Interfaces\UserFactory::class,
            Factories\UserFactory::class
        );

        $this->app->bind(
            Domain\Interfaces\UserRepository::class,
            Repositories\UserRepository::class
        );
        
        $this->app
            ->when(HttpControllers\UserController::class)
            ->needs(UseCases\CreateUser\CreateUserInputPort::class)
            ->give(function ($app) {
                return $app->make(UseCases\CreateUser\CreateUserInteractor::class, [
                    'output' => $app->make(Presenters\CreateUserHttpPresenter::class),
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
