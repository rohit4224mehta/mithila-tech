<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();         // Title of the about section
            $table->text('description')->nullable();     // General description
            $table->text('mission')->nullable();         // Mission statement
            $table->text('vision')->nullable();          // Vision statement
            $table->text('history')->nullable();         // Company history
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}