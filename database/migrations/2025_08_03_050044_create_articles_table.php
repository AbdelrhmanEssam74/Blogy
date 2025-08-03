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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id');
            $table->text('content');
            $table->string('image')->nullable()->comment('Image URL or path');
            $table->string('title');
            $table->string('slug')->unique()->comment('URL-friendly version of the title');
            $table->unsignedBigInteger('writer_id')->comment('ID of the user who wrote the article');
            $table->foreign('writer_id')->references('user_id')->on('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->unsignedBigInteger('category_id')->comment('ID of the category the article belongs to');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade')->comment('Foreign key to categories table');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->comment('Status of the article');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
