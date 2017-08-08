<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillsSeeder extends Seeder
{
    public function run() :void
    {
        $this->createDisabledSkills();
        $this->createRegularSkills();
    }

    public function createRegularSkills(int $number = 10) : void
    {
        factory(Skill::class, $number)->create();
    }

    public function createDisabledSkills(int $number = 10) : void
    {
        factory(Skill::class, $number)->create([
            'active' => 0
        ]);
    }
}