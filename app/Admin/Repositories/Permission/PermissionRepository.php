<?php

namespace App\Admin\Repositories\Permission;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Permission\PermissionRepositoryInterface;
use App\Models\Permission;
use App\Models\Module;

class PermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Permission::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
	
	public function getAllModules() {
		return Module::all();
	}
}