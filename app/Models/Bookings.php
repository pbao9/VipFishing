<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $table = "bookings";

    protected $guarded = [];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lakechild()
    {
        return $this->belongsTo(Lakechilds::class, 'lakeChild_id');
    }

    public function fishingset()
    {
        return $this->belongsTo(FishingSet::class, 'fishingset_id');
    }

    public function compensation()
    {
        return $this->hasOne(Compensations::class, 'booking_id');
    }

    public function bookingLake()
    {
        return $this->hasOne(BookingLake::class, 'booking_id');
    }
}
