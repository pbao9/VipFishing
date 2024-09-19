<?php

namespace App\Admin\Repositories\BookingLake;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface BookingLakeRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}