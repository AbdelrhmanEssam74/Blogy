<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /**
         * comment_id
         * content
         * article_id
         * user_id
         * status
         * created_at
         */
        \DB::table('comments')->insert([
            [
                'content' => 'This is a comment 1 on the article.',
                'article_id' => 6,
                'user_id' => 11,
                'status' => 'approved',
                'created_at' => now(),
            ],
            [
                'content' => 'This is a comment 2 on the article.',
                'article_id' => 6,
                'user_id' => 11,
                'status' => 'pending',
                'created_at' => now(),
            ],
            [
                'content' => 'This is a comment 3 on the article.',
                'article_id' => 6,
                'user_id' => 11,
                'status' => 'rejected',
                'created_at' => now(),
            ],
            [
                'content' => 'This is a comment 1 on the article.',
                'article_id' => 8,
                'user_id' => 11,
                'status' => 'approved',
                'created_at' => now(),
            ],
            [
                'content' => 'This is a comment 2 on the article.',
                'article_id' => 8,
                'user_id' => 11,
                'status' => 'pending',
                'created_at' => now(),
            ],
            [
                'content' => 'This is a comment 3 on the article.',
                'article_id' => 8,
                'user_id' => 11,
                'status' => 'rejected',
                'created_at' => now(),
            ]
        ]);
    }
}
