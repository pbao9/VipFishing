<?php

namespace App\Admin\Repositories\Lakechilds;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface OperatingRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function findOrFailWithRelations($id, $relations = ['lake', 'fishingSet']);

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'activity_date', 'lake_child_id']);
}
