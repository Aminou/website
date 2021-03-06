<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function createPost($params, $method = 'create')
    {
        if ( ! in_array($method, ['create', 'make', 'raw'])) {
            return null;
        }

        return factory(Post::class)->$method($params);
    }

    public function test_if_a_user_can_create_post()
    {
        $user = $this->createNewLoggedInUser('admin');

        $post = $this->createPost(['user_id' => $user->getKey()], 'raw');

        $this->post('/posts/create', $post);

        $this->assertDatabaseHas('posts', ['title' => $post['title']]);

    }


    public function test_regular_user_cant_create_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = $this->createPost(['user_id' => $user->getKey()], 'raw');

        $this->expectException('App\Exceptions\CantDoThisException');
        $this->post('/posts/create', $post);

    }

    public function test_if_owner_can_update_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = $this->createPost([
            'user_id' => $user->getKey()
        ]);

        $this->post('/posts/update/' . $post->slug, [
            'title' => 'updated title'
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'updated title'
        ]);
    }

    public function test_if_common_user_cant_update_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = $this->createPost([
            'user_id' => function() {
                return $this->createUser(['type' => 'admin'])->id;
            }
        ]);

        $this->expectException('App\Exceptions\CantDoThisException');

        $this->post('/posts/update/' . $post->slug, [
            'title' => 'updated title'
        ]);
    }

    public function test_if_we_can_create_a_post_if_were_not_logged()
    {
        $user = factory('App\User')->create();
        $post = $this->createPost(['user_id' => $user->id], 'raw');

        $this->expectException(AuthenticationException::class);
        $this->post('/posts/create', $post);
    }


    public function test_if_we_can_publish_a_post()
    {
        $user = $this->createNewLoggedInUser();

        $post = $this->createPost([
            'user_id' => $user->getKey(),
            'published_at' => null
        ]);

        $this->post('/posts/publish/' . $post->slug);

        $this->assertTrue($post->fresh()->isPublished());
    }

    public function test_filters_by_author_name()
    {
        $user = $this->createNewLoggedInUser();
        $post = factory(Post::class, 10)->create([
            'user_id' => $user->getKey(),
            'active' => 1
        ]);

        $this->get('/posts/?author=' . $user->firstname . ' ' . $user->lastname)
            ->assertSee($post->random()->title);
    }

    /** @test **/
    public function it_test_the_author_filter_with_a_reversed_name()
    {
        $user = $this->createNewLoggedInUser();
        $post = factory(Post::class, 10)->create([
            'user_id' => $user->getKey(),
            'active' => 1
        ]);

        $this->get('/posts/filters/author/' . $user->lastname . ' ' . $user->firstname)
            ->assertSee($post->random()->title);
    }

    /** @test **/
    public function it_tries_to_filter_with_an_unknown_author_name()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class, 10)->create([
            'user_id' => $user->getKey(),
            'active' => 1
        ]);

        $this->get('/posts/filters/author/Gregory Marshall')
             ->assertSuccessful();
    }

    /** @test **/
    public function it_test_the_author_filter_if_it_has_3_words()
    {
        // test starts here.
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class, 10)->create([
            'user_id' => $user->getKey(),
            'active' => 1
        ]);

        $this->get('/posts/filters/author/' . $user->firstname. ' ' . $user->lastname. ' blabla')
            ->assertSuccessful()
            ->assertSeeText($post->random()->title);
    }

    public function test_filters_by_author_id()
    {
        $user = $this->createNewLoggedInUser();

        $post = factory(Post::class, 10)->create([
            'user_id' => $user->getKey(),
            'active' => 1
        ]);

        $this->get('/posts/filters/by/' . $user->id)
             ->assertSee($post->random()->title);
    }

    public function test_filter_by_year()
    {
        $date = Carbon::createFromDate(2015, random_int(1, 12), random_int(1, 12));

        $posts = factory(Post::class, 10)->create([
            'active' => 1,
            'published_at' => $date
        ]);

        $this->get('/posts/filters/year/' . $date->year)
            ->assertStatus(200)
            ->assertSee($posts->random()->title);
    }

    /** @test **/
    public function it_tries_to_filter_post_with_an_unknown_filter()
    {
        $posts = factory(Post::class, 10)->create([
            'active' => 1,
            'published_at' => Carbon::now()
        ]);

        $this->get('/posts/filters/unknownFilter/10')
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

        $this->get('/posts/filters/year/' . $right_date->year)
             ->assertSee($newer_posts->random()->title)
             ->assertDontSeeText($older_posts->random()->title);


    }

    public function test_multiple_post_filters()
    {
        $date = Carbon::createFromDate(2018, random_int(1,12), random_int(1,28));
        $owner = $this->createNewLoggedInUser();
        $wrong_date = Carbon::createFromDate(2016, random_int(1,12), random_int(1,28));
        $posts = factory(Post::class, 10)->create([
            'active' => 1,
            'published_at' => $date,
            'user_id' => $owner->id
        ]);

        $bad_post = factory(Post::class, 10)->create([
           'active' => 1,
           'published_at' => $wrong_date,
           'user_id' => function () {
                return factory('App\User')->create()->id;
           }
        ]);

        $this->get('/posts/filters/year/' . $date->year . '/by/' . $owner->id)
             ->assertSee($posts->random()->title)
             ->assertDontSee($bad_post->random()->title);
    }

}