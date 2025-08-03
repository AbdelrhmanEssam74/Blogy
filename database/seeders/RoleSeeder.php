<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert default roles into the roles table
        \DB::table('roles')->insert([
            ['role_name' => 'admin', 'description' => 'Administrator with full access'],
            ['role_name' => 'author', 'description' => 'Author with content creation rights'],
            ['role_name' => 'writer', 'description' => 'Writer with create and edit access'],
            ['role_name' => 'reader', 'description' => 'Reader with view-only access'],
        ]);

        // Optionally, you can log the seeding action
        \Log::info('Roles seeded successfully.');
    }
}
