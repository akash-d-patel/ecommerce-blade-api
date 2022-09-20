<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

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
            'mobile_no' => $this->faker->regexify('91[0-9]{10}'),
            'address_line1' => $this->faker->address,
            'address_line2' => $this->faker->address,
            'landmark' => $this->faker->optional()->words(3, true),
            // 'country_id' => $this->faker->country_id,
            // 'state_id' => $this->faker->state_id,
            // 'city_id' => $this->faker->city_id,
            'pin_code' => $this->faker->regexify('[0-9]{6}'),
            'address_type' => 'Home',
            'status' => 'Active',
            'created_by' => User::factory(),
        ];
    }
}
