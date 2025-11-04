<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionsOverview extends Model
{
    protected $fillable = [
        'badge',
        'title',
        'description',
    ];
}