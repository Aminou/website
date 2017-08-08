<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(JobsSeeder::class);
        $this->call(SkillsSeeder::class);
        $this->call(ToolsSeeder::class);
    }
}
