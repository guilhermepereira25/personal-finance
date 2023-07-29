<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private array $data;
    private string $fakeName;
    private string $fakeEmail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fakeName = fake()->name();
        $this->fakeEmail = fake()->email();

        $this->data = [
            'user_name' => $this->fakeName,
            'user_email' => $this->fakeEmail,
            'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];
    }

    public function test_it_can_store_a_user()
    {
        //Act
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->postJson('/user', $this->data);
        
        //Assert
        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'User created successfully',
                'user' => $this->data
            ]);
        $this->assertDatabaseHas('users', $this->data);
    }

    public function test_it_can_show_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/user/$user->user_id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => $user->getAttributes()
            ]);
    }
}