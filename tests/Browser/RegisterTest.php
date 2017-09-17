<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RegisterTest extends DuskTestCase
{
    use RefreshDatabase;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $user = factory('App\User')->make();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->type('firstname', $user->firstname)
                    ->type('lastname', $user->lastname)
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->waitForLocation('/')
                    ->assertSee($user->firstname);
        });
    }
}
