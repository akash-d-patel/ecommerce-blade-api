<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::all()->random()->id,
            'title' => $this->faker->name,
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph,
            'status' => 'Active',
            'created_by' => User::factory()
        ];
    }
}
