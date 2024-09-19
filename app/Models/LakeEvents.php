<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LakeEvents extends Model
{
    use HasFactory;

    protected $table = "lakeEvents";

    protected $guarded = [];

    protected $casts = [];

}
