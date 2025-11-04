<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCultureValuesTable extends Migration
{
    public function up()
    {
        Schema::create('culture_values', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Culture value title (e.g., "Collaborative Spirit")
            $table->text('description')->nullable(); // Description of the value
            $table->string('icon')->nullable(); // Bootstrap icon class (e.g., bi-people-fill)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('culture_values');
    }
}