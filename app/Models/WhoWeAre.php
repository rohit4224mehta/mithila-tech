<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhoWeAre extends Model
{
    protected $fillable = ['title', 'description', 'founder_name', 'founder_color'];
}