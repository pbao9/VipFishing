<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingLake extends Model
{
    use HasFactory;

    protected $table = "bookingLake";

    protected $guarded = [];

    protected $casts = [];

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }

    public function variationfish()
    {
        return $this->belongsTo(VariationFishs::class, 'variationFishs_id');
    }

}
