<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

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

    public function test_if_user_has_an_image()
    {
        $user = $this->createUser();

        $image = factory('App\Document', 'avatar')->create([
            'documentable_id' => $user->id,
        ]);

        $this->assertEquals($image->path, $user->fresh()->avatar->path);
    }

    public function test_if_a_user_is_activable()
    {
        $user = $this->createUser(['active' => 0]);

        $user->activate();

        $this->assertTrue($user->fresh()->isActive());

        $user->disable();

        $this->assertTrue($user->fresh()->isDisabled());
    }

    /** @test **/
    public function it_checks_if_a_user_has_an_avatar()
    {
        $user = $this->createNewLoggedInUser();
        $this->repo->addAvatar($user->id, UploadedFile::fake()->image('avatar.jpg'));
        $image = $this->repo->getAvatar($user->id);

        $this->assertFileExists('storage/app/public/users/'. $image);
    }
    





}
