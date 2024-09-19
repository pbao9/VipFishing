<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseLakes extends Model
{
    use HasFactory;

    protected $table = "closeLakes";

    protected $guarded = [];

    protected $casts = [];

    public function lakechild(){
        return $this->belongsTo(Lakechilds::class, 'lakechild_id');
    }
}
