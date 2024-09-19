<?php

namespace App\Models;

use App\Enums\Lakes\StatusLake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lakechilds extends Model
{
    use HasFactory;

    protected $table = "lake_childs";

    protected $guarded = [];
    protected $casts = [
        'open_day' => 'array',
    ];

    public function lake()
    {
        return $this->belongsTo(Lakes::class, 'lake_id');
    }
    public function lakeFish()
    {
        return $this->belongsTo(LakeFishs::class, 'lakechild_id');
    }

    public function closeLakes()
    {
        return $this->hasMany(CloseLakes::class, 'lakechild_id');
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'lakeChild_id');
    }
    public function fish()
    {
        return $this->belongsTo(Fishs::class, 'fish_id', 'id');
    }
    public function fishingSets()
    {
        return $this->belongsToMany(FishingSet::class, 'lake_childs_fishing_set', 'lakeChild_id', 'fishingSet_id');
    }

    // public function countRate()
    // {
    //     return $this->hasMany(Ratings::class, 'lakechild_id', 'id');
    // }

    public function ratings(): HasMany
    {
        return $this->hasMany(Ratings::class, 'lakechild_id', 'id');
    }

    public function scopePublish($query)
    {
        return $query->where('status', StatusLake::active());
    }

    public function activityDates()
    {
        return $this->hasMany(ActivitySchedule::class, 'lake_child_id', 'id');
    }

    public function countRate(): int
    {
        return Ratings::whereHas('booking', function ($query) {
            $query->where('lakeChild_id', $this->id);
        })->count();
    }


    public function avgRating(): float
    {
        $averageRateValue = Ratings::whereHas('booking', function ($query) {
            $query->where('lakeChild_id', $this->id);
        })->avg('rate');

        return round($averageRateValue, 1);
    }
}
