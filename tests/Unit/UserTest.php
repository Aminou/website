<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->repo = app('App\Repositories\UsersRepo');
    }

    public function test_user_is_created()
    {
        $user = $this->createUser();

        $this->assertDatabaseHas('users',[
           'id' => $user->getKey()
        ]);
    }

    public function test_user_is_deleted()
    {
        $user = $this->createUser();

        $this->repo->delete($user->getKey());

        $this->assertDatabaseMissing('users', [
           'id' => $user->getKey()
        ]);
    }
}
