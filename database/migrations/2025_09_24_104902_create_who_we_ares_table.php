<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhoWeAresTable extends Migration
{
    public function up()
    {
        Schema::create('who_we_ares', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('founder_name');
            $table->string('founder_color');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('who_we_ares');
    }
}