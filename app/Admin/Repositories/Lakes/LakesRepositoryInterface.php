<?php

namespace App\Admin\Repositories\Lakes;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface LakesRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
