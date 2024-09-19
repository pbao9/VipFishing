<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishingRating extends Model
{
    use HasFactory;

    protected $table = "fishing_rating";

    protected $guarded = [];

    protected $casts = [];
}
