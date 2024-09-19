<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvents extends Model
{
    use HasFactory;

    protected $table = "userEvents";

    protected $guarded = [];

    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(){
        return $this->belongsTo(Events::class, 'event_id');
    }

}
