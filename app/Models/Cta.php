<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cta extends Model
{
    protected $fillable = [
        'page',
        'title',
        'description',
        'start_action',
        'phone',
        'call_action',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page');
    }
}