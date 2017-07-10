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
    public function run() : void
    {
        $this->myAccount();

        factory(User::class, 100)->create();
        factory(User::class, 'headhunter', 50)->create();
    }

    public function myAccount() : void
    {
        factory(User::class)->create([
           'firstname' => 'Amine',
           'lastname' => 'Bendib',
           'email' => 'abendib@gmail.com',
           'job_title' => 'PHP Developer',
           'address' => '19, rue de Rocroy',
           'postcode' => '75010',
           'phone' => '0675668136',
           'city' => 'Paris',
           'password' => bcrypt('nazim09'),
           'type' => 'admin',
           'active' => 1
        ]);
    }
}
