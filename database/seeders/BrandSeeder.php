<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Brand::factory()->create([
            'name' => 'Puma',
            'description' => 'Puma desc',
            'order' => '1',
        ]);
        \App\Models\Brand::factory()->create([
            'name' => 'Addidas',
            'description' => 'Addidas desc',
            'order' => '2',
        ]);
        \App\Models\Brand::factory()->create([
            'name' => 'Nike',
            'description' => 'Nike desc',
            'order' => '3',
        ]);
        \App\Models\Brand::factory()->create([
            'name' => 'New Balance',
            'description' => 'New Balance desc',
            'order' => '4',
        ]);

    }
}
