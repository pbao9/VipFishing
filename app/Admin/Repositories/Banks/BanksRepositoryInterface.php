<?php

namespace App\Admin\Repositories\Banks;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface BanksRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name'], $limit = 10);
}