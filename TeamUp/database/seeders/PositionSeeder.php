<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('positions')->insert([
        ['id' => $faker->uuid, 'name' => 'Computer Scientist'],
        ['id' => $faker->uuid, 'name' => 'IT Professional'],
        ['id' => $faker->uuid, 'name' => 'UX Designer & UI Developer'],
        ['id' => $faker->uuid, 'name' => 'SQL Developer'],
        ['id' => $faker->uuid, 'name' => 'Web Designer'],
        ['id' => $faker->uuid, 'name' => 'Web Developer'],
        ['id' => $faker->uuid, 'name' => 'Help Desk Worker/Desktop Support'],
        ['id' => $faker->uuid, 'name' => 'Software Engineer'],
        ['id' => $faker->uuid, 'name' => 'Data Entry'],
        ['id' => $faker->uuid, 'name' => 'DevOps Engineer'],
        ['id' => $faker->uuid, 'name' => 'Computer Programmer'],
        ['id' => $faker->uuid, 'name' => 'Network Administrator'],
        ['id' => $faker->uuid, 'name' => 'Information Security Analyst'],
        ['id' => $faker->uuid, 'name' => 'Artificial Intelligence Engineer'],
        ['id' => $faker->uuid, 'name' => 'Cloud Architect'],
        ['id' => $faker->uuid, 'name' => 'IT Manager'],
        ['id' => $faker->uuid, 'name' => 'Technical Specialist'],
        ['id' => $faker->uuid, 'name' => 'Application Developer'],
        ['id' => $faker->uuid, 'name' => 'Chief Technology Officer (CTO)'],
        ['id' => $faker->uuid, 'name' => 'Chief Information Officer (CIO)']
        ]);
    }
}
