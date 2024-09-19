<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balances extends Model
{
    use HasFactory;

    protected $table = "balances";

    protected $guarded = [];

    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}