<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Client;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'name' => $this->faker->name,
            'created_by' => User::factory()
        ];
    }
}
