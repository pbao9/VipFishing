<?php

namespace App\Admin\Repositories\Withdraws;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface WithdrawsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}