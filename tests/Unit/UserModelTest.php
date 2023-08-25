<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    protected $userFactory;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userFactory = User::factory()->create();
        $this->user = User::findOrFail($this->userFactory->id);
    }

    public function test_that_user_is_created(): void
    {
        $this->assertDatabaseCount('users', 1);
        $this->assertSame($this->user->id, $this->userFactory->id);
        $this->assertEquals($this->user->name, $this->userFactory->name);
        $this->assertEquals($this->user->email, $this->userFactory->email);
    }

    public function test_update_email(): void
    {
        $newEmail = 'new_email@email.com';

        $this->user->email = $newEmail;
        $this->user->update(); 

        $this->assertEquals($newEmail, $this->user->email);
    }
}
