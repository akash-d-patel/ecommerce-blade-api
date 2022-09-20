<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'client_id' => null,
            'name' => 'Super Admin',
            'email' => 'superadmin@jencysoftware.com'
        ]);
        \App\Models\User::factory()->create([
            'client_id' => '1',
            'name' => 'Client 1',
            'email' => 'client1@jencysoftware.com'
        ]);
        \App\Models\User::factory()->create([
            'client_id' => '1',
            'name' => 'Client 2',
            'email' => 'client2@jencysoftware.com'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Jency Software',
            'email' => 'demo@jencysoftware.com'
        ]);
        \App\Models\User::factory(50)->create();
    }
}
