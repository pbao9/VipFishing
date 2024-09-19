<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $table = "events";

    protected $guarded = [];

    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rank(){
        return $this->belongsTo(Ranks::class, 'rank_id');
    }

    public function lakechild(){
        return $this->belongsTo(Lakechilds::class, 'lakechild_id');
    }
}