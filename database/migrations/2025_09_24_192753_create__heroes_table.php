<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroesTable extends Migration
{
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // To differentiate home vs. services
            $table->string('title');
            $table->text('subtitle');
            $table->string('focus_areas')->nullable(); // Home-specific
            $table->string('call_to_action')->nullable(); // Home-specific
            $table->text('quote')->nullable(); // Home-specific
            $table->string('explore_action')->nullable(); // Services-specific
            $table->string('contact_action')->nullable(); // Services-specific
            $table->string('background_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('heroes');
    }
}