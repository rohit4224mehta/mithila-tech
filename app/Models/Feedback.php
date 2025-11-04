<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // ✅ Explicitly set the table name to match your database
    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'project_id',
        'rating',
        'comment',
    ];

    // Optional relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
