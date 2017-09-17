<?php

namespace Tests\Features;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase {

    use RefreshDatabase;

    public function test_if_user_can_register()
    {
        $user = factory('App\User')->make([
            'password' => 'secret'
        ]);

        $this->post('/register', [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ]);

        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }
}