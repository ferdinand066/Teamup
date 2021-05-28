<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $times = random_int(2, 5);

        $address_data['street'] = $this->faker->streetName;
        $address_data['city'] = $this->faker->city;
        $address_data['state'] = $this->faker->state;
        $address_data['postal_code'] = $this->faker->postcode;
        
        return [
            //
            'id' => $this->faker->uuid(),
            'creator_id' => User::inRandomOrder()->limit(1)->select('id')->get()->toArray()['0']['id'],
            'name' => $this->faker->domainName,
            'short_description' => $this->faker->text(80),
            'full_description' => $this->faker->text(200),
            'salary' => $this->faker->numberBetween(1, 100000),
            'position_list' => json_encode(Position::inRandomOrder()->limit($times)->select('id')->get()->toArray()),
            'address'=> json_encode($address_data)
        ];
    }
}
