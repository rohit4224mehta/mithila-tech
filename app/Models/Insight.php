<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(InsightPost::class);
    }
}