<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'products_attributes';

    protected $guarded = [];
    
    public function attributeVariations(){
        return $this->belongsToMany(AttributeVariation::class, 'products_attributes_variations', 'product_attribute_id', 'attribute_variation_id')->orderBy('position', 'asc');
    }
    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

}
