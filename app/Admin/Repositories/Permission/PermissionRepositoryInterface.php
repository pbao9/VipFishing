<?php

namespace App\Admin\Repositories\Permission;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface PermissionRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
	public function getAllModules();
}