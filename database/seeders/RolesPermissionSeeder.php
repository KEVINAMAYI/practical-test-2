<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Create Roles
        $roles = [
            'admin',
            'staff',
            'travel_agent',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        //Create Permissions and Assign to Roles
        $permissions = [
            ['name' => 'travel_agent.create', 'description' => 'Can create Travel Agent'],
            ['name' => 'travel_agent.view', 'description' => 'Can view Travel Agents'],
            ['name' => 'travel_agent.edit', 'description' => 'Can edit Travel Agents'],
            ['name' => 'travel_agent.delete', 'description' => 'Can delete Travel Agents'],
            ['name' => 'accommodation.create', 'description' => 'Can create Accommodation'],
            ['name' => 'accommodation.view', 'description' => 'Can view Accommodation'],
            ['name' => 'accommodation.edit', 'description' => 'Can edit Accommodation'],
            ['name' => 'accommodation.delete', 'description' => 'Can delete Accommodation'],
            ['name' => 'contract.create', 'description' => 'Can create Contract'],
            ['name' => 'contract.view', 'description' => 'Can view Contract'],
            ['name' => 'contract.edit', 'description' => 'Can edit Contract'],
            ['name' => 'contract.delete', 'description' => 'Can delete Contract'],
            ['name' => 'accommodation-allocation.create', 'description' => 'Can create Accommodation Allocation'],
            ['name' => 'accommodation-allocation.view', 'description' => 'Can view Accommodation Allocation'],
            ['name' => 'accommodation-allocation.edit', 'description' => 'Can edit Accommodation Allocation'],
            ['name' => 'accommodation-allocation.delete', 'description' => 'Can delete Accommodation Allocation']
        ];



        foreach ($permissions as $permission) {
            if (Permission::where('name', $permission['name'])->first()) {
                continue;
            }
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description']
            ]);
        }


        //Admin
        $adminRole = Role::where('name', 'admin')->first();
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        $admin = User::where('email', 'admin@admin.com')->first();
        $admin->assignRole($adminRole);


       //Staff
        $staffRole = Role::where('name', 'staff')->first();
        $permissions = Permission::where("name", "not like", "%delete%")->get();
        $staffRole->syncPermissions($permissions);

        $staff = User::where('email', 'staff@admin.com')->first();
        if ($staff) {
            $staff->assignRole($staffRole);
        }

        //Travel Agent
        $travelAgentRole = Role::where('name', 'travel_agent')->first();
        $permissions = Permission::where("name", "not like", "%delete%")
                                   ->orWhere("name", "not like", "%edit%")->get();
        $travelAgentRole->syncPermissions($permissions);

        $travelAgent = User::where('email', 'travelagent@admin.com')->first();
        if ($travelAgent) {
            $travelAgent->assignRole($travelAgentRole);
        }
    }
}
