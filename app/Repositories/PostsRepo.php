<?php
namespace App\Repositories;

use App\Post;

class PostsRepo extends BaseRepository
{

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function publish($id)
    {
        return $this->find($id)->publish();
    }

}