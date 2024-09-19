<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fishs extends Model
{
    use HasFactory;

    protected $table = "fishs";

    protected $guarded = [];

    protected $casts = [];


    public function provinces() : BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function variationFishes() : HasMany
    {
        return $this->hasMany(VariationFishs::class,'fish_id');
    }

}
