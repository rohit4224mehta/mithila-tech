<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'icon',
        'slug',
        'meta_description',
        'status', // Ensure this column exists in the migration
    ];

    public function features()
    {
        return $this->hasMany(ServiceFeature::class);
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}