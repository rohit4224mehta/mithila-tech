<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->enum('type', ['highlight', 'press_release'])->default('highlight');
            $table->string('source', 255)->nullable(); // e.g., Tech Journal
            $table->string('image', 255)->nullable(); // Image path
            $table->string('link', 255)->nullable(); // External link or PDF
            $table->date('published_at')->nullable(); // Publication date
            $table->string('tags')->nullable(); // e.g., "Expansion,New Office"
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}