<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::all()->random()->id,
            'name' => $this->faker->name,
            'status' => 'Active',
            'created_by' => User::factory(),
        ];
    }
}
