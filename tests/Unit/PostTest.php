<?php

namespace Tests\Unit;

use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function createPost(\App\User $author = null)
    {
        $params = (null !== $author) ? ['user_id' => $author->id] : [];
        return factory(Post::class)->create($params);
    }

    public function test_if_a_user_can_create_post()
    {
        $user = $this->createNewLoggedInUser('admin');

        $post = factory(Post::class)->make(['user_id' => $user->getKey()]);

        $this->post('/posts/create', $post->toArray());

        $this->assertDatabaseHas('posts', ['title' => $post->title]);

    }


    public function test_if_an_admin_can_create_a_post()
    {
        $user = $this->createNewLoggedInUser('admin');

        $post = factory(Post::class)->make(['user_id' => $user->id]);

        $this->post('/posts/create', $post->toArray())
             ->assertSee($post->title);
    }


    public function test_regular_user_cant_create_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class)->make(['user_id' => $user->getKey()]);

        $this->expectException('App\Exceptions\CantDoThisException');
        $this->post('/posts/create', $post->toArray());

    }

    public function test_if_owner_can_update_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class)->create([
            'user_id' => $user->getKey()
        ]);

        $this->post('/posts/update/' . $post->getKey(), [
            'title' => 'updated title'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'updated title'
        ]);
    }

    public function test_if_common_user_cant_update_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class)->create([
            'user_id' => function() {
                return factory('App\User')->create(['type' => 'admin'])->id;
            }
        ]);

        $this->expectException('App\Exceptions\CantDoThisException');

        $this->post('/posts/update/' . $post->getKey(), [
            'title' => 'updated title'
        ]);
    }

    public function test_if_we_can_create_a_post_if_were_not_logged()
    {
        $user = factory('App\User')->create();
        $post = factory(Post::class)->make(['user_id' => $user->id]);

        $this->expectException(AuthenticationException::class);
        $this->post('/posts/create', $post->toArray());
    }


    public function test_if_we_can_publish_a_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class)->create([
            'user_id' => $user->getKey(),
            'published_at' => null
        ]);

        $this->post('/posts/publish/' . $post->getKey());

        $published_post = Post::find($post->getKey());
        $this->assertTrue($published_post->isPublished());
    }

}