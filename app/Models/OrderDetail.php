<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $table = 'order_details';
    
    protected $guarded = [];
    
    protected $casts = [
        'detail' => AsArrayObject::class
    ];
}
