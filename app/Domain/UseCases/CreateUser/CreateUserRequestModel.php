<?php 

namespace App\Domain\UseCases\CreateUser;

class CreateUserRequestModel
{
    public function __construct(
        private array $attributes
    )
    {
    }

    public function getName(): string
    {
        return $this->attributes['user_name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['user_email'];
    }

    public function getPassword(): string
    {
        return $this->attributes['user_password'];
    }

    public function getAttribute(string $key): string
    {
        return $this->attributes[$key] ?? null;
    }
}