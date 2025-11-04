<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('badge');
            $table->string('title');
            $table->text('lead_description');
            $table->text('additional_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processes');
    }
}