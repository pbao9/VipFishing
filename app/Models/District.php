<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $incrementing = false;

    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function wards() : HasMany
    {
        return $this->hasMany(Ward::class);
    }
}
