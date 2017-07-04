<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->myAccount();

        factory(User::class, 100);
    }

    public function myAccount() {
        factory(User::class)->create([
           'firstname' => 'Amine',
           'lastname' => 'Bendib',
           'email' => 'abendib@gmail.com',
           'password' => bcrypt('nazim09'),
           'type' => 'admin',
           'active' => 1
        ]);
    }
}
