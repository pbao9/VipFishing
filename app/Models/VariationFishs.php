<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationFishs extends Model
{
    use HasFactory;

    protected $table = "variationFishs";

    protected $guarded = [];

    protected $casts = [];

    public function fish()
    {
        return $this->belongsTo(Fishs::class, 'fish_id');
    }
}
