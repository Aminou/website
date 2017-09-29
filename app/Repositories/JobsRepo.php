<?php

namespace App\Repositories;

use App\Job;

class JobsRepo extends BaseRepository
{
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    public function create(array $data)
    {
        $data['active'] = 1;
        $data['slug'] = str_slug($data['title']);

        return parent::create($data);
    }
}