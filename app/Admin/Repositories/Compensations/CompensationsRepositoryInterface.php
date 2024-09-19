<?php

namespace App\Admin\Repositories\Compensations;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface CompensationsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}