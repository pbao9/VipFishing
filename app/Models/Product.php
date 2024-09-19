<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Support\Eloquent\Sluggable;
use App\Enums\Product\ProductType;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'products';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
    }

    protected $casts = [
        'gallery' => AsArrayObject::class,
        'type' => ProductType::class,
        'is_active' => 'boolean',
        'in_stock' => 'boolean',
        'price' => 'double',
        'promotion_price' => 'double'
    ];
    public function isSimple(){
        return $this->type == ProductType::Simple();
    }
    public function categories(){
        return $this->belongsToMany(Category::class, 'products_categories', 'product_id', 'category_id')->orderBy('position', 'asc');
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class, ProductAttribute::class, 'product_id', 'attribute_id')->orderBy('position', 'asc');
    }
    public function productAttributes(){
        return $this->hasMany(ProductAttribute::class, 'product_id')->orderBy('position', 'asc');
    }

    public function productVariations(){
        return $this->hasMany(ProductVariation::class, 'product_id')->orderBy('position', 'asc');
    }
    public function productVariation(){
        return $this->hasOne(ProductVariation::class, 'product_id');
    }
    public function scopeActive($query){
        return $query->where('is_active', true);
    }
    public function scopeUserDiscount($query){
        return $query->where('is_user_discount', true);
    }
    public function scopeSimple($query){
        return $query->where('type', ProductType::Simple);
    }
    public function scopeVariable($query){
        return $query->where('type', ProductType::Variable);
    }
}
