<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\State::factory()->create([
            'country_id' => '1',
            'name' => 'Gujarat'
        ]);
        \App\Models\State::factory()->create([
            'country_id' => '2',
            'name' => 'California'
        ]);
        \App\Models\State::factory()->create([
            'country_id' => '3',
            'name' => 'Wales'
        ]);
        \App\Models\State::factory()->create([
            'country_id' => '4',
            'name' => 'Auckland'
        ]);
    }
}
