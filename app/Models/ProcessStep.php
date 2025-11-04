<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = ['process_id', 'title', 'description'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}