<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LakeFishs extends Model
{
    use HasFactory;

    protected $table = "lakeFishs";

    protected $guarded = [];

    protected $casts = [];

    public function fish()
    {
        return $this->belongsTo(Fishs::class, 'fish_id', 'id');
    }

    public function lake_child()
    {
        return $this->belongsTo(Lakechilds::class, 'lakechild_id', 'id');
    }


}