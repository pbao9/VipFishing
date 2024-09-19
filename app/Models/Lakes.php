<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Lakes extends Model
{
    use HasFactory;

    protected $table = "lakes";

    protected $fillable = [
        'latitude',
        'longitude',
        'name',
        'phone',
        'province_id',
        'map',
        'description',
        'car_parking',
        'dinner',
        'lunch',
        'toilet',
        'avatar',
        'status',
    ];

    protected $casts = [];

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function lakechilds()
    {
        return $this->hasMany(Lakechilds::class, 'lake_id');
    }
    public function countLakechilds()
    {
        return $this->hasMany(Lakechilds::class, 'lake_id', 'id')->count();
    }

    public function countRating(): int
    {
        return Ratings::whereHas('booking.lakechild', function ($query) {
            $query->where('lake_id', $this->id);
        })->count();
    }

    public function ratings()
    {
        return $this->hasManyThrough(Ratings::class, Lakechilds::class, 'lake_id', 'booking_id', 'id', 'id')
            ->join('bookings', 'bookings.id', '=', 'ratings.booking_id');
    }

    public function avgRating(): float
    {
        $averageRateValue = Ratings::whereHas('booking.lakechild', function ($query) {
            $query->where('lake_id', $this->id);
        })->avg('rate');

        return round($averageRateValue, 1);
    }
}
