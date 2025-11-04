<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration
     {
         public function up(): void
         {
             Schema::create('employees', function (Blueprint $table) {
                 $table->id();
                 $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
                 $table->string('employee_id')->nullable()->unique();
                 $table->string('first_name')->nullable();
                 $table->string('last_name')->nullable();
                 $table->string('job_title')->nullable(); // e.g., Software Engineer, DevOps
                 $table->decimal('salary', 10, 2)->nullable(); // Salary with 2 decimal places
                 $table->foreignId('manager_id')->nullable()->constrained('employees')->onDelete('set null'); // Self-referential for hierarchy
                 $table->string('work_location')->nullable(); // e.g., Office, Remote
                 $table->text('skills')->nullable(); // e.g., JSON array of skills like ["PHP", "Laravel"]
                 $table->enum('employment_type', ['full-time', 'part-time', 'contract'])->nullable();
                 $table->string('department')->nullable();
                 $table->date('join_date')->nullable();
                 $table->date('end_date')->nullable(); // Optional end date for contract employees
                 $table->timestamps();
             });
         }

         public function down(): void
         {
             Schema::dropIfExists('employees');
         }
     };
