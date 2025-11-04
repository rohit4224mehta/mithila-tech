<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $fillable = ['badge', 'title', 'lead_description', 'additional_description'];

    public function steps()
    {
        return $this->hasMany(ProcessStep::class);
    }
}