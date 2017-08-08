<?php
use Illuminate\Database\Seeder;
use App\Post;

class PostsSeeder extends Seeder
{
    public function run() : void
    {
        $this->createPostFromAdmin(10);
        $this->createUnpublishedPosts(10);
        $this->createRegularPost(10);
    }

    public function createUnpublishedPosts(int $number)
    {
        factory(Post::class, $number)->create([
            'published_at' => null
        ]);
    }

    public function createPostFromAdmin(int $number)
    {
        factory(Post::class, $number)->create([
            'user_id' => 1
        ]);
    }

    public function createRegularPost(int $number)
    {
        factory(Post::class, $number)->create();
    }
}