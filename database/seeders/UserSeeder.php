<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\User::factory(10)->create();

        //ADMIN
        $adminData = [
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ];

        $criteria = [
            'email' => $adminData['email'],
        ];

        User::firstOrCreate($criteria, $adminData);


        //STAFF
        $staffData = [
            'first_name' => 'Staff',
            'last_name' => 'Staff',
            'email' => 'staff@admin.com',
            'password' => 'password',
        ];

        $criteria = [
            'email' => $staffData['email'],
        ];

        User::firstOrCreate($criteria, $staffData);

        //TRAVEL AGENT
        $travelAgentData = [
            'first_name' => 'TravelAgent',
            'last_name' => 'TravelAgent',
            'email' => 'travelagent@admin.com',
            'password' => 'password',
        ];

        $criteria = [
            'email' => $travelAgentData['email'],
        ];

        User::firstOrCreate($criteria, $travelAgentData);
    }
}
