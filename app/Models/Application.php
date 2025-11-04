<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'career_id', 'name', 'email', 'phone', 'cover_letter', 'resume_path', 'status',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}