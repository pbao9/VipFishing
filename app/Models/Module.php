<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $guarded = [];
	
	protected $casts = [];
	
	/**
     * Lấy các Permissions của Module đó.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
