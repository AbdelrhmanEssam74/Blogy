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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name')->unique()->comment('Name of the category');
            $table->string('description')->nullable()->comment('Description of the category');
            $table->string('image')->nullable()->comment('Image URL or path for the category');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('ID of the parent category, for hierarchical categories');
            $table->foreign('parent_id')->references('category_id')->on('categories')->onDelete('cascade')->comment('Foreign key to self for hierarchical categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
