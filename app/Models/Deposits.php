<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    use HasFactory;

    protected $table = "deposits";

    protected $guarded = [];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }

    public function scopeDepositPending($query)
    {
        return $query->where('status', 0);
    }
}
