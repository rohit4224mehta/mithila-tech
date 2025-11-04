<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['title', 'subtitle', 'focus_areas', 'call_to_action', 'quote', 'background_image'];
}