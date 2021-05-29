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
        return [
            //
            'team_id' => Team::inRandomOrder()->limit(1)->select('id')->get()->toArray()['0']['id'],
            'member_id' => User::inRandomOrder()->limit(1)->select('id')->get()->toArray()['0']['id'],
            'position_id' => Position::inRandomOrder()->limit(1)->select('id')->get()->toArray()['0']['id']
        ];
    }
}
