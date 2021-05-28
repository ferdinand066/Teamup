<?php

namespace Database\Seeders;

use App\Models\Team;
use Database\Factories\TeamFactory;
use Illuminate\Database\Seeder;

class TeamSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::factory()->count(200)->create();
    }
}
