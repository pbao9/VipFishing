<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishingSet extends Model
{
    use HasFactory;

    protected $table = "fishingSet";

    protected $guarded = [];

    protected $casts = [];
    public function lakechilds()
    {
        return $this->belongsToMany(lakechilds::class, 'lake_childs_fishing_set', 'fishingSet_id', 'lakeChild_id');
    }

}
