<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\UploadedFile;

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

    public function test_image_upload()
    {
        \Storage::fake('avatars');
        $user = $this->createNewLoggedInUser();

        $this->post('/users/avatar', [
            'id' => $user->id,
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        \Storage::disk('avatars')->assertExists($user->id . '/avatar.jpg');
        $this->get('users/image/' . $user->id)->assertSee('avatar.jpg');
    }

    public function test_admin_has_access_to_backoffice()
    {
        $user = $this->createNewLoggedInUser('admin');

        $this->get('admin')
             ->assertSee('Fellow Admin');
    }
}