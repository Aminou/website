<?php
namespace App\Repositories;

use App\User;
use Event;

class UsersRepo extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function createUser($data)
    {
        return $this->create($data);
    }

}