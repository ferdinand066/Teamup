<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'balance' => $this->faker->numberBetween(0, 200),
            'role' => 'User',
            'password' => Hash::make('admin123'),
            'picture_path' => null,
            'phone' => '08' . $this->faker->numerify('##########'),
            'experience' => null
        ];
    }
}
