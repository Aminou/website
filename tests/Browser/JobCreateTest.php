<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobCreateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_create_job()
    {
        $job = factory('App\Job')->make();

        $this->browse(function (Browser $browser) use ($job) {

            $browser->loginAs($user = factory('App\User')->create([
                'type' => 'admin'
            ]));



            $browser->visit('/admin/job/create')
                ->type('title', $job->title)
                ->type('job_title', $job->job_title)
                ->type('company', $job->company)
                ->type('url', $job->url)

                ->keys('input[name=start_date]', $job->start_date)

                ->keys('input[name=end_date]', $job->end_date)
                ->type('description', $job->description)
                ->radio('type', $job->type)
                ->press('Send')
                ->waitForText($job->title)
                ->assertSee($job->title);
        });
    }
}
