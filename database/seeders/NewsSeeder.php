<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\News::factory()->create([
            'title' => 'Times Of India',
            'order' => '1',
        ]);
        \App\Models\News::factory()->create([
            'title' => 'Gujarat Samachar',
            'order' => '2',
        ]);
        \App\Models\News::factory()->create([
            'title' => 'Divya Bhaskar',
            'order' => '3',
        ]);
        \App\Models\News::factory()->create([
            'title' => 'Sandesh',
            'order' => '4',
        ]);
    }
}
