<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserScores extends Model
{
    use HasFactory;

    protected $table = "userScores";

    protected $guarded = [];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
