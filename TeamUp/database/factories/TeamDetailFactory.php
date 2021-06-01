<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Team;
use App\Models\TeamDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $team_data = Team::inRandomOrder()->limit(1)->select('id', 'creator_id')->get()->toArray()['0'];
        $member_id = User::where('id', '!=', $team_data['creator_id'])->inRandomOrder()->limit(1)->select('id')->get()->toArray()['0']['id'];

        // while(TeamDetail::where([['team_id', '=', $team_data['id']], ['member_id', '=', $member_id]])->get() != []){
        //     $team_data = Team::inRandomOrder()->limit(1)->select('id', 'creator_id')->get()->toArray()['0'];
        //     $member_id = User::where('id', '!=', $team_data['creator_id'])->inRandomOrder()->limit(1)->select('id')->get()->toArray()['0']['id'];
        // }

        
        $teams = Team::where('id', '=', $team_data['id'])->get();
        $position_list = json_decode($teams[0]->position_list);
        
        $temp = array();
        foreach($position_list as $key => $value){
            array_push($temp, $value->id);
        }
          

        return [
            //
            'team_id' => $team_data['id'],
            'member_id' => $member_id,
            'position_id' => $temp[random_int(0, count($temp) - 1)],
            'is_accepted' => $this->faker->boolean(70)
        ];
    }
}
