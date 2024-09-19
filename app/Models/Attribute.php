<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Support\Eloquent\Sluggable;
use App\Enums\Attribute\AttributeType;

class Attribute extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'attributes';

    protected $guarded = [];

    protected $casts = [
        'type' => AttributeType::class
    ];

    public function variations()
    {
        return $this->hasMany(AttributeVariation::class, 'attribute_id')->orderBy('position', 'asc');
    }


}
