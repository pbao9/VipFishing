<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionHistory extends Model
{
    use HasFactory;

    protected $table = "commissionHistory";

    protected $guarded = [];

    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booking(){
        return $this->belongsTo(Bookings::class, 'booking_id');
    }
}
