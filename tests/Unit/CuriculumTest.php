<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CuriculumTest extends TestCase
{
    use RefreshDatabase;

    public function test_my_cv()
    {
         $this->seed('UsersSeeder');

         $this->get('/')
              ->assertSuccessful()
              ->assertSeeText('Amine BENDIB');
    }

    public function test_users_cv()
    {
        $user = $this->createUser();

        $this->get('/cv/' . $user->id)
             ->assertSuccessful()
             ->assertSeeText($user->firstname);
    }
}
