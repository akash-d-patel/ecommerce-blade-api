<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory()->create([
            'name' => 'Honda',
            'description' => 'Honda desc',
            'order' => '1',
        ]);
        \App\Models\Category::factory()->create([
            'parent_id' => '1',
            'name' => 'Activa',
            'description' => 'Activa desc',
            'order' => '2',
        ]);
        \App\Models\Category::factory()->create([
            'parent_id' => '1',
            'name' => 'Unicorn',
            'description' => 'Unicorn desc',
            'order' => '3',
        ]);
        \App\Models\Category::factory()->create([
            'parent_id' => '1',
            'name' => 'Dream Yuda',
            'description' => 'Dream Yuda desc',
            'order' => '4',
        ]);
    }
}
