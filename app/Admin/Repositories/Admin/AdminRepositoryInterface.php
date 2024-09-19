<?php

namespace App\Admin\Repositories\Admin;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface AdminRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * make query
     * 
     * @return mixed
     */
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);

	public function getAllRoles();
	public function syncAdminRoles($adminid, $rolesRequestArray);
}