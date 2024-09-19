<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart';

    protected $guarded = [];

    // protected $casts = [
    //     'qty' => 'integer'
    // ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productVariation(){
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    public function scopeCurrentAuth($query){
        return $query->where('user_id', auth()->user()->id);
    }
}
