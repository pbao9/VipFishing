<?php

namespace App\Admin\Services\Role;

use App\Admin\Services\Role\RoleServiceInterface;
use  App\Admin\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleService implements RoleServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(RoleRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();
		$role = Role::create($this->data);
		
		// Lấy ID của vai trò mới tạo
        $roleId = $role->id;
		
		// Lưu các permissions cho vai trò mới tạo
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            //$role->permissions()->attach($permissions);
			 $role->syncPermissions($permissions);
        }
		
		return $roleId;
    }

    public function update(Request $request){
        
        $this->data = $request->validated();
		
		 $role = Role::findOrFail($this->data['id']);
		 
		 // Cập nhật danh sách category của sách
		 $role->syncPermissions($request->permissions);
        //$roles->permissions()->sync($request->permissions);
		
        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);
    }

}