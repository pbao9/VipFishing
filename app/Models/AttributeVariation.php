<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Support\Eloquent\Sluggable;

class AttributeVariation extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'attributes_variations';

    protected $guarded = [];

    protected $casts = [
        'meta_value' => AsArrayObject::class
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
