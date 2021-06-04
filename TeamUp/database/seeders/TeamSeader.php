<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TeamSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Team::factory()->count(400)->create();

        foreach(Team::all() as $team){
            $members = User::where('id', '!=', $team->id)->inRandomOrder()->take(rand(1,8))->pluck('id');
            foreach($members as $member){

                $position_list = json_decode($team->position_list);
        
                $temp = array();
                foreach($position_list as $key => $value){
                    array_push($temp, $value->id);
                }
                $team->members()->attach($member, 
                    ['is_accepted' => $faker->boolean(70), 
                    'position_id' => $temp[random_int(0, count($temp) - 1)]
                    ]);
                
                DB::table('forums')->insert([
                    'id' => $faker->uuid(),
                    'user_id' => $member,
                    'team_id' => $team->id,
                    'content' => $faker->text(250),
                    'created_at' => (new DateTime('now', new DateTimeZone('Asia/Bangkok')))->format('Y-m-d H:i:s')
                ]);
                
            }
        }
    }
}
