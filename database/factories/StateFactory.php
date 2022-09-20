<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::all()->random()->id,
            'country_id' => Country::all()->random()->id,
            'name' => $this->faker->name,
            'created_by' => User::factory(),
        ];
    }
}
