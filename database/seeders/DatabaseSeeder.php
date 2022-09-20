<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            AddressSeeder::class,
            NewsSeeder::class,
        ]); 
        Artisan::call("passport:purge");
        Artisan::call("passport:install");
        Artisan::call("telescope:clear");
        
    }
}
