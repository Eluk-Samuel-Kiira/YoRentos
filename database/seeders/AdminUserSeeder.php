<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Default Roles
        $all_roles = [
            'Landlord',
            'Tenant',
            'Broker',
            'Admin'
        ];
        foreach ($all_roles as $role) {
            Role::create(['name' => $role]);
        }


        // All Other Permissions
        $permissions = [
            'manage all',
            'create rentals',
            'edit rentals',
            'update status',
            'delete rentals',
            'create user',
            'edit user',
            'delete user',
            'create estate',
            'edit estate',
            'delete estate',
            'create location',
            'edit location',
            'delete location',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //Give him all the permissions
        $adminRole = Role::where(['name' => 'Admin'])->first();
        $permissions = Permission::all(); // Change $permission to $permissions
        $adminRole->syncPermissions($permissions);
 
        $adminUser = User::factory()->create([
            'name' => 'Samuel Kiira Eluk',
            'phone_number' => '0754428612',
            'role' => 'Admin',
            'slug' => 'samuel-kiira-admin',
            'email' => 'samuelkiiraeluk@gmail.com',
            'password' => bcrypt('Samuel@13Kiira')
        ]);
        $adminUser->assignRole('Admin');
    }
}
