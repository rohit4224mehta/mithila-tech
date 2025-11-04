<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title', 'slug', 'location', 'type', 'experience', 'category',
        'description', 'benefits', 'status',
    ];

    protected $casts = [
        'benefits' => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}