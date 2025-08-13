<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            [
                'full_name' => 'Abdelrhman Essam',
                'email' => 'abdelrhmanroshdy8@gmail.com',
                'password' => bcrypt('123456789'),
                'role_id' => 1, // Assuming 1 is the ID for the admin role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Fatma Mahmoud',
                'email' => 'fatma@yahoo.com',
                'password' => bcrypt('123456789'),
                'role_id' => 2,  // Assuming 2 is the ID for the author role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mohamed Abdulrahman',
                'email' => 'mohamed@yahoo.com',
                'password' => bcrypt('123456789'),
                'role_id' => 3, // Assuming 3 is the ID for the writer role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Radwa Abdulrahman',
                'email' => 'radwa@yahoo.com',
                'password' => bcrypt('123456789'),
                'role_id' => 4,// Assuming 4 is the ID for the reader role
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
