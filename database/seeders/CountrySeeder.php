<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Country::factory()->create([
            'name' => 'India',
        ]);
        \App\Models\Country::factory()->create([
            'name' => 'USA',
        ]);
        \App\Models\Country::factory()->create([
            'name' => 'UK',
        ]);
        \App\Models\Country::factory()->create([
            'name' => 'New Zealand',
        ]);
    }
}
