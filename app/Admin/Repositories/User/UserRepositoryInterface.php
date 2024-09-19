<?php

namespace App\Admin\Repositories\User;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function findWithRelations($id, $relations = []);
}
