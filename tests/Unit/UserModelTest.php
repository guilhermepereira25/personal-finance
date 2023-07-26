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
        $this->user = User::findOrFail($this->userFactory->user_id);
    }

    public function test_that_user_is_created(): void
    {
        $this->assertDatabaseCount('users', 1);
        $this->assertSame($this->user->user_id, $this->userFactory->user_id);
        $this->assertEquals($this->user->user_name, $this->userFactory->user_name);
        $this->assertEquals($this->user->user_email, $this->userFactory->user_email);
    }

    public function test_update_user_email(): void
    {
        $newEmail = 'new_email@email.com';

        $this->user->user_email = $newEmail;
        $this->user->update(); 

        $this->assertEquals($newEmail, $this->user->user_email);
    }
}
