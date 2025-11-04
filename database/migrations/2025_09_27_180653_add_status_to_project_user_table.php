<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('project_user', function (Blueprint $table) {
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending')->after('role');
    });
}

public function down()
{
    Schema::table('project_user', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
