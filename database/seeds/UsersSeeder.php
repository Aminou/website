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
        $this->createMyAccount();
        $this->createAdminAccounts();
        $this->createDisabledAccounts(50);
        $this->createHeadHunters(10);
        $this->createRegularAccounts(101);
    }

    public function createRegularAccounts(int $number = 100) : void
    {
        factory(User::class, $number)->create();
    }

    public function createHeadHunters(int $number = 50) : void
    {
        factory(User::class, $number)->create([
            'type' => 'headhunter'
        ]);
    }

    public function createAdminAccounts(int $number = 2) : void
    {
        factory(User::class, $number)->create([
            'type' => 'admin'
        ]);
    }

    public function createDisabledAccounts(int $number = 30) : void
    {
        factory(User::class, $number)->create([
           'active' => 0
        ]);
    }
    public function createMyAccount() : void
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
           'password' => bcrypt('password'),
           'type' => 'admin',
           'active' => 1
        ]);
    }
}
