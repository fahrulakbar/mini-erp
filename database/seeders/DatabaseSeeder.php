<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('secretservice'),
            'role' => User::ROLE_SUPERADMIN,
        ]);

        User::create([
            'name' => 'Sales',
            'email' => 'sales@gmail.com',
            'password' => bcrypt('secretservice'),
            'role' => User::ROLE_SALES,
        ]);

        User::create([
            'name' => 'Admin Purchase',
            'email' => 'admin_purchase@gmail.com',
            'password' => bcrypt('secretservice'),
            'role' => User::ROLE_ADMIN_PURCHASE,
        ]);

        User::create([
            'name' => 'Admin Warehouse',
            'email' => 'admin_warehouse@gmail.com',
            'password' => bcrypt('secretservice'),
            'role' => User::ROLE_ADMIN_WAREHOUSE,
        ]);
    }
}
