<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;

    public function districts() : HasMany
    {
        return $this->hasMany(District::class);
    }
}
