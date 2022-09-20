<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\City::factory()->create([
            'state_id' => '1',
            'name' => 'Navsari'
        ]);
        \App\Models\City::factory()->create([
            'state_id' => '2',
            'name' => 'Los Angeles'
        ]);
        \App\Models\City::factory()->create([
            'state_id' => '3',
            'name' => 'Cardiff'
        ]);
        \App\Models\City::factory()->create([
            'state_id' => '4',
            'name' => 'Parnell'
        ]);
    }
}
