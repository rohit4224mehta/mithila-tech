<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultureValue extends Model
{
    protected $table = 'culture_values';
    protected $fillable = ['title', 'description', 'icon'];
}
