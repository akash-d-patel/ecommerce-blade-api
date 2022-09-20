<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::factory()->create([
            'name' => 'Super Admin',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Admin',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Client',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Staff',
        ]);
    }
}
