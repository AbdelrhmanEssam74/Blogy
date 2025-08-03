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
        Schema::create('writer_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->comment('ID of the user who is a writer');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->comment('Foreign key to users table');
            $table->string('bio')->nullable()->comment('Biography of the writer');
            $table->string('website')->nullable()->comment('Website of the writer');
            $table->string('social_media_links')->nullable()->comment('Social media links of the writer');
            $table->string('profile_picture')->nullable()->comment('Profile picture of the writer');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Status of the writer profile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writer_profile');
    }
};
