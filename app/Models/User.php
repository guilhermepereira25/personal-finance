<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Casts\EmailValueObject;
use App\Domain\Interfaces\UserEntity;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements UserEntity
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'users';

    public $incrementing = false;
    protected $keyType = 'string';

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function goal(): HasMany
    {
        return $this->hasMany(Goal::class, 'user_id', 'id');
    }
    
    public function budget(): HasMany
    {
        return $this->hasMany(Budget::class, 'user_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email' => EmailValueObject::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }
}
