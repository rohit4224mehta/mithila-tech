<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'icon',
        'slug',
        'meta_description',
        'status',
    ];

    // public function features()
    // {
    //     return $this->hasMany(SolutionFeature::class);
    // }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
