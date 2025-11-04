<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'evaluation_date',
        'score',
        'comments',
        'user_id',
    ];

    protected $casts = [
        'evaluation_date' => 'date',
        'score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
