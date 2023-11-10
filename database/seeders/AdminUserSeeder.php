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
        // //Register the Super Admin by default
        // User::create([
        //     'name' => 'Samuel Kiira Eluk',
        //     'email' => 'samuelkiiraeluk@gmail.com',
        //     // 'mobile' => '256754428612',
        //     'password' => bcrypt('Samuel@13Kiira')
        // ]);

        //Give him all the permissions
        $adminRole = Role::create(['name' => 'Admin']);
        $permission = Permission::create(['name' => 'manage all']);
        $permission->assignRole($adminRole);
 
        $adminUser = User::factory()->create([
            'name' => 'Samuel Kiira Eluk',
            'phone_number' => '0754428612',
            'role_id' => '3',
            'slug' => 'samuel-kiira-admin',
            'email' => 'samuelkiiraeluk@gmail.com',
            'password' => bcrypt('Samuel@13Kiira')
        ]);
        $adminUser->assignRole('Admin');
    }
}
