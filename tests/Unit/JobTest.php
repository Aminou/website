<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JobTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_job_has_a_owner()
    {
        $user = $this->createUser();

        $job = factory('App\Job')->create(['user_id' => $user->id]);

        $this->assertSame($job->id, $user->fresh()->jobs->first()->id);

    }
}
