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
        // Create abouts table
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('founded_year')->nullable();
            $table->unsignedInteger('team_size')->nullable();
            $table->unsignedInteger('countries_served')->nullable();
            $table->timestamps();
        });

        // Create team_members table
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('position', 255)->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // Create process_steps table (assumes processes table exists)
        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained('processes')->onDelete('cascade');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->unsignedInteger('order');
            $table->timestamps();
        });

        // Create applications table
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('career_id')->constrained('careers')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('resume_path', 255);
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        // Create testimonials table
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->string('author', 255);
            $table->string('company', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
        Schema::dropIfExists('process_steps');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('abouts');
        Schema::dropIfExists('testimonials');
    }
};
?>