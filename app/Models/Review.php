<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'reviewer_name', 'rating', 'comments'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}