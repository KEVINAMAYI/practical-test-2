<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StatusSeeder::class,
            RolesPermissionSeeder::class
        ]);

        \App\Models\TravelAgent::factory(10)->create();
        \App\Models\Accommodation::factory(10)->create();
        \App\Models\Contract::factory(10)->create();
        \App\Models\Accommodation_allocation::factory(10)->create();

    }
}
