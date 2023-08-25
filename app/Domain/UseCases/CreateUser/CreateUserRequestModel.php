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
        return $this->attributes['name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function getAttribute(string $key): string
    {
        return $this->attributes[$key] ?? null;
    }
}