<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $table = "ratings";

    protected $guarded = [];

    protected $casts = [
        'picture' => AsArrayObject::class,
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id', 'id');
    }
}
