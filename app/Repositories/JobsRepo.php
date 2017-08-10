<?php

namespace App\Repositories;

use App\Job;

class JobsRepo extends BaseRepository
{
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }
}