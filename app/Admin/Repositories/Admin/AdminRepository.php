<?php

namespace App\Admin\Repositories\Admin;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

class AdminRepository extends EloquentRepository implements AdminRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Admin::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'fullname', 'phone'], $limit = 10){
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);
        
        foreach($meta as $key => $value){
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('username', 'LIKE', '%'.$key.'%')
            ->orWhere('phone', 'LIKE', '%'.$key.'%')
            ->orWhere('email', 'LIKE', '%'.$key.'%')
            ->orWhere('fullname', 'LIKE', '%'.$key.'%');
        });
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->with('roles')->orderBy($column, $sort);
        return $this->instance;
    }


	public function getAllRoles() {
		return Role::all();
	}
	
	public function getAllRolesByGuardName($guardName) {
		return Role::where('guard_name', $guardName)->get();
	}
	
	public function syncAdminRoles($adminid, $rolesRequestArray) {
		$admin = Admin::findOrFail($adminid); // Tìm trong Model Admin có admin id không
		$admin->syncRoles($rolesRequestArray); // Đồng bộ lại các Roles của Admin
        return 1;
	}

}