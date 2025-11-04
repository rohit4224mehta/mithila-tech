<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('projects', 'client_name')) {
                $table->string('client_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('projects', 'progress')) {
                $table->integer('progress')->default(0)->after('status');
            }
            // Update existing columns if needed
            $table->date('start_date')->nullable(false)->change();
            $table->date('deadline')->nullable(false)->change();
            $table->enum('status', ['pending', 'in_progress', 'under_review', 'completed', 'planning'])->default('pending')->change();
        });

        Schema::table('project_user', function (Blueprint $table) {
            if (!Schema::hasColumn('project_user', 'role')) {
                $table->string('role')->nullable()->after('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('client_name');
            $table->dropColumn('progress');
            $table->date('start_date')->nullable()->change();
            $table->date('deadline')->nullable()->change();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending')->change();
        });

        Schema::table('project_user', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
