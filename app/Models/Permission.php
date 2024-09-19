<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $guarded = [];
	
	protected $casts = [];
	

    /**
     * Xác định mối quan hệ many-to-many với bảng roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
	
	
	// Định nghĩa mối quan hệ với bảng Module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Phương thức để lấy tên của Module
    public function getModuleName()
    {
        if ($this->module) {
			return '<a target="_blank" href="module/sua/'.$this->module->id.'">'.$this->module->name.'</a>';
		} else {
			return '<span class="badge bg-red-lt">Không có Module</span>';
		}
    }
}
