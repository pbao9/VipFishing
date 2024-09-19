<?php

namespace App\Admin\Repositories\CommissionHistory;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface CommissionHistoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}