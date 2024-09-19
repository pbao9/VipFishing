<?php

namespace App\Admin\Repositories\Role;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Role\RoleRepositoryInterface;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Module;

class RoleRepository extends EloquentRepository implements RoleRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Role::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
	
	public function getAllPermissions() {
		return Permission::all();
	}
	
	public function getAllPermissionsNoModule() {
		return Permission::all()->whereNull('module_id');
	}
	
	public function getAllModules() {
		return Module::all();
	}
	
	public function getAllPermissionsInAllModules() {
		$arrModule = Module::all();
		foreach($arrModule as $module) {
			$permssionsList[$module->id]['module_name']  = $module->name;
			$permssionsList[$module->id]['list']  = Permission::where('module_id', $module->id)->get();
		}
		return $permssionsList;
	}
}