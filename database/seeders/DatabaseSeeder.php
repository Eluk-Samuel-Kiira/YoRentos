<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Samuel Kiira Eluk',
        //     'email' => 'samuelkiiraeluk@gmail.com',
        //     'password' => bcrypt('Samuel@13Kiira'),
        // ]);

        //Role and Permissions
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
