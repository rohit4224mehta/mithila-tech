<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtasTable extends Migration
{
    public function up()
    {
        Schema::create('ctas', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('title');
            $table->text('description');
            $table->string('start_action');
            $table->string('phone');
            $table->string('call_action');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ctas');
    }
}