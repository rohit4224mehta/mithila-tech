<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsAndProjectUserTables extends Migration
{
    public function up()
    {
        // Update existing projects table
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'client_id')) {
                $table->foreignId('client_id')->constrained('users')->onDelete('cascade')->nullable()->after('client_name');
            }
            if (!Schema::hasColumn('projects', 'hours')) {
                $table->integer('hours')->default(0)->after('progress');
            }
        });

        // Create project_user table
        if (!Schema::hasTable('project_user')) {
            Schema::create('project_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('project_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('role')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
            $table->dropColumn('hours');
        });
        Schema::dropIfExists('project_user');
    }
}
