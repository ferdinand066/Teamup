<?php

namespace Database\Seeders;

use App\Models\TeamDetail;
use Illuminate\Database\Seeder;

class TeamDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TeamDetail::factory()->count(2000)->create();
    }
}
