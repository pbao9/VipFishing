<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = "notifications";

    protected $guarded = [];

    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}