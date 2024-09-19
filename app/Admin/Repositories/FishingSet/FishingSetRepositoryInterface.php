<?php

namespace App\Admin\Repositories\FishingSet;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface FishingSetRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'title'], $limit = 10);
}