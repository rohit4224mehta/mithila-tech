<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerLogo extends Model
{
    protected $fillable = ['partner_id', 'name', 'image_url'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}