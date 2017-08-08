<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobsSeeder extends Seeder
{

    public function run() : void
    {
        $this->createRegularJobs();
        $this->createDisabledJobs();
    }

    public function createRegularJobs(int $number = 10) :void
    {
        factory(Job::class, $number)->create();
    }

    public function createDisabledJobs(int $number = 10) :void
    {
        factory(Job::class, $number)->create([
            'active' => 0
        ]);
    }

}