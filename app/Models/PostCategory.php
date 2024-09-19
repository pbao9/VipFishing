<?php

namespace App\Models;

use App\Enums\PostCategory\PostCategoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Support\Eloquent\Sluggable;
use Kalnoy\Nestedset\NodeTrait;

class PostCategory extends Model
{
    use HasFactory, Sluggable, NodeTrait;
    
    protected $table = 'posts_categories';

    protected $guarded = [];

    protected $casts = [
        'status' => PostCategoryStatus::class
    ];
    protected static function boot()
    {
        parent::boot();
    }
    public function isPublished(){
        return $this->status == PostCategoryStatus::Published();
    }

    public function categories(){
        return $this->belongsToMany(PostCategory::class, 'posts_posts_categories', 'category_id', 'post_id');
    }

    public function scopePublished($query){
        return $query->where('status', PostCategoryStatus::Published);
    }
}
