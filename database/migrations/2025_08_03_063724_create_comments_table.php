<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->text('content')->comment('Content of the comment');
            $table->unsignedBigInteger('article_id')->comment('ID of the article the comment belongs to');
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade')->comment('Foreign key to articles table');
            $table->unsignedBigInteger('user_id')->comment('ID of the user who made the comment');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Status of the comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
