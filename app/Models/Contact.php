<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'consent',
        'status',
    ];

    protected $casts = [
        'consent' => 'boolean',
    ];
}
