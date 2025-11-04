<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Seed users with unique emails
        $rohit = User::create([
            'name' => 'Rohit Sharma',
            'email' => 'rohit.sharma.new@example.com', // Changed to a unique email
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        $priya = User::create([
            'name' => 'Priya Patel',
            'email' => 'priya.patel@example.com', // Ensure this is also unique if needed
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        // Seed admin user with unique email
        User::create([
            'name' => 'Admin User',
            'email' => 'admin.user@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Seed client user with unique email
        User::create([
            'name' => 'Client User',
            'email' => 'client.user@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // Seed employees table for users with role 'employee'
        Employee::create([
            'user_id' => $rohit->id,
            'employee_id' => 'EMP001',
            'first_name' => 'Rohit',
            'last_name' => 'Sharma',
            'job_title' => 'Software Engineer',
            'salary' => 75000.00,
            'manager_id' => null,
            'work_location' => 'Office',
            'skills' => json_encode(['PHP', 'Laravel', 'MySQL']),
            'employment_type' => 'full-time',
            'department' => 'Development',
            'join_date' => now(),
            'end_date' => null,
        ]);

        Employee::create([
            'user_id' => $priya->id,
            'employee_id' => 'EMP002',
            'first_name' => 'Priya',
            'last_name' => 'Patel',
            'job_title' => 'HR Manager',
            'salary' => 65000.00,
            'manager_id' => null,
            'work_location' => 'Remote',
            'skills' => json_encode(['HR Management', 'Recruitment']),
            'employment_type' => 'full-time',
            'department' => 'HR',
            'join_date' => now()->subDays(30),
            'end_date' => null,
        ]);
    }
}
