<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Post;

class PostTest extends TestCase
{
    use DatabaseMigrations;
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create(['type' => 'admin']);
    }
    public function test_if_a_user_can_create_post()
    {
        $this->be($this->user);

        $response = $this->post('/posts/create', factory(Post::class)->make(['user_id' => $this->user->id])->toArray())->decodeResponseJson();

        $this->get('/posts/' . $response['id'])
             ->assertSee($response['title']);

    }

    public function test_if_we_can_create_a_post()
    {
        $this->be($this->user);

        $post = factory(Post::class)->make(['user_id' => $this->user->id]);

        $this->post('/posts/create', $post->toArray())
             ->assertSee($post->title);
    }

    /**
     *
     */
    public function test_if_we_can_see_post()
    {
        $post = factory(Post::class)->create(['user_id' => 1]);

        $this->get('/posts/' . $post->id)
             ->assertSee($post->title);
    }

}
