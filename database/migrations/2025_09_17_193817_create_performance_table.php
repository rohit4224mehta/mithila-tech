<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceTable extends Migration
{
    public function up()
    {
        Schema::create('performance', function (Blueprint $table) {
            $table->id();
            $table->date('evaluation_date');
            $table->integer('score')->default(0);
            $table->text('comments')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('performance');
    }
}
