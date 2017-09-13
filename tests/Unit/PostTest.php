<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use DB;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function createPost($user_id)
    {
        $params = (null !== $user_id) ? ['user_id' => $user_id] : [];
        return factory(Post::class)->create($params);
    }

    public function test_if_a_user_can_create_post()
    {
        $user = $this->createNewLoggedInUser('admin');

        $post = factory(Post::class)->raw(['user_id' => $user->getKey()]);

        $this->post('/posts/create', $post);

        $this->assertDatabaseHas('posts', ['title' => $post['title']]);

    }


    public function test_regular_user_cant_create_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class)->raw(['user_id' => $user->getKey()]);

        $this->expectException('App\Exceptions\CantDoThisException');
        $this->post('/posts/create', $post);

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
        $post = factory(Post::class)->raw(['user_id' => $user->id]);

        $this->expectException(AuthenticationException::class);
        $this->post('/posts/create', $post);
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


    public function test_filters_by_author_id()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class, 10)->create([
            'user_id' => $user->getKey(),
            'active' => 1
        ]);

        $this->get('/posts/?by=' . $user->id)
             ->assertSee($post->random()->title);
    }

    public function test_filter_by_year()
    {
        $date = Carbon::createFromDate(2015, random_int(1, 12), random_int(1, 12));

        $posts = factory(Post::class, 10)->create([
            'active' => 1,
            'published_at' => $date
        ]);

        $this->get('/posts/?year=' . $date->year)
            ->assertStatus(200)
            ->assertSee($posts->random()->title);

    }

    public function test_cant_see_posts_filtered()
    {
        $date = Carbon::createFromDate(2015, random_int(1, 12), random_int(1,28));
        $right_date = Carbon::createFromDate(2016, random_int(1, 12), random_int(1, 28));

        $older_posts = factory(Post::class, 10)->create([
            'active' => 1,
            'published_at' => $date
        ]);

        $newer_posts = factory(Post::class, 10)->create([
            'active' => 1,
            'published_at' => $right_date
        ]);

        $this->get('/posts/?year=' . $right_date->year)
             ->assertSee($newer_posts->random()->title)
             ->assertDontSeeText($older_posts->random()->title);


    }

}