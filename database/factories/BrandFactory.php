<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

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
            'description' => $this->faker->paragraph,
            'status' => 'Active',
            'created_by' => User::factory(),
        ];
    }
}
