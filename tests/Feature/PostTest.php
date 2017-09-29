<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    protected $repo;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->repo = app('App\Repositories\PostsRepo');
    }


    public function test_if_we_can_create_a_post()
    {
        $this->assertTrue(true);
    }
}
