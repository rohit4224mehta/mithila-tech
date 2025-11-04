<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'employee_id', 'first_name', 'last_name', 'job_title', 'salary',
        'manager_id', 'work_location', 'skills', 'employment_type', 'department',
        'join_date', 'end_date',
    ];

    protected $table = 'employees'; // Explicitly define the table name

   public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

}