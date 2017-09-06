<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createNewLoggedInUser($type = null)
    {
        $params = (null !== $type) ? ['type' => $type] : [];

        $this->be($user = $this->createUser($params));

        return $user;
    }

    public function createUser(array $params = [])
    {
        return factory(User::class)->create($params);
    }
}
