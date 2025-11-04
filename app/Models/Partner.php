<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['badge', 'title', 'description'];

    public function logos()
    {
        return $this->hasMany(PartnerLogo::class);
    }
}