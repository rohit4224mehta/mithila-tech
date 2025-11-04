<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title', 'description', 'type', 'source', 'image', 'link', 'published_at', 'tags', 'status'
    ];

    protected $casts = [
        'published_at' => 'date',
    ];
}