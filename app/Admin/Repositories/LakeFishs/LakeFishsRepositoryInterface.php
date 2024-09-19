<?php

namespace App\Admin\Repositories\LakeFishs;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface LakeFishsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}