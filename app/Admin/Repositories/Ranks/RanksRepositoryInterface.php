<?php

namespace App\Admin\Repositories\Ranks;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface RanksRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'title'], $limit = 10);
}