<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WriterProfile extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('writer_profile')->insert([
            [
                'user_id' => 9, // foreign key for user_id
                'bio' => 'A passionate writer with a love for storytelling.',
                'website' => 'https://example.com/writer1',
                'social_media_links' => json_encode(['twitter' => 'https://twitter.com/writer1', 'linkedin' => 'https://linkedin.com/in/writer1']),
                'profile_picture' => 'path/to/profile_picture.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'bio' => 'An experienced writer with a knack for technical writing.',
                'website' => 'https://example.com/writer2',
                'profile_picture' => 'path/to/profile_picture.jpg',
                'status' => 'inactive',
                'social_media_links' => json_encode(['twitter' => 'https://twitter.com/writer2', 'linkedin' => 'https://linkedin.com/in/writer2']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
