<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsightPost extends Model
{
    protected $fillable = ['title', 'excerpt', 'image_url', 'slug'];

    public function insight()
    {
        return $this->belongsTo(Insight::class);
    }
}