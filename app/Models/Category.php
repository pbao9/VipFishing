<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Support\Eloquent\Sluggable;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, Sluggable, NodeTrait;

    protected $table = 'categories';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
    }
    public function products(){
        return $this->belongsToMany(Product::class, 'products_categories', 'category_id', 'product_id')
        ->orderBy('id', 'DESC');
    }
    public function scopeActive($query){
        return $query->where('is_active', true);
    }
    public function scopeWhereIdOrSlug($query, $idOrSlug){
        return $query->where('id', $idOrSlug)->orWhere('slug', $idOrSlug);
    }
}
