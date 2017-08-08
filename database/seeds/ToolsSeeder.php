<?php
use Illuminate\Database\Seeder;
use App\Tool;

class ToolsSeeder extends Seeder
{

    public function run() : void
    {
        $this->createRegularTools();
        $this->createDisabledTools();
    }

    public function createRegularTools(int $number = 10) : void
    {
        factory(Tool::class, $number)->create();
    }

    public function createDisabledTools(int $number = 10) : void
    {
        factory(Tool::class, $number)->create([
            'active' => 0
        ]);
    }
}