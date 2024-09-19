<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ward extends Model
{
    use HasFactory;

//    protected $fillable = ['id', 'name', 'district_id'];
    protected $guarded = [];

    public $incrementing = false;

    public function district() : BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
