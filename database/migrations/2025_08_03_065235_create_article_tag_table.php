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
        Schema::create('article_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id')->comment('ID of the article');
            $table->unsignedBigInteger('tag_id')->comment('ID of the tag');
            $table->primary(['article_id', 'tag_id'], 'article_tag_primary_key')->comment('Composite primary key for article and tag');
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade')->comment('Foreign key to articles table');
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('cascade')->comment('Foreign key to tags table');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_tag');
    }
};
