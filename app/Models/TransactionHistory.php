<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = "transactionHistory";

    protected $guarded = [];

    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
