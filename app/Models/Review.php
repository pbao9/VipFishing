<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeAuthCurrent($query){
        return $query->where('user_id', auth('sanctum')->user()->id);
    }
}
