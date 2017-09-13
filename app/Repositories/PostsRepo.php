<?php
namespace App\Repositories;

use App\Post;
use Carbon\Carbon;

class PostsRepo extends BaseRepository
{

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function filter($filter)
    {
        return $this->query()->filter($filter)->get();
    }

    public function publish($id)
    {
        return $this->_updatePublishedState($id, Carbon::now());
    }

    public function unpublish($id)
    {
        return $this->_updatePublishedState($id);
    }

    private function _updatePublishedState($id, $state = null)
    {
        $post = $this->find($id);

        $post->published_at = $state;

        return $post->save();
    }


}