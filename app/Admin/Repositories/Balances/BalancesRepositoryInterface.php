<?php

namespace App\Admin\Repositories\Balances;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface BalancesRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAllBalances($column = 'id', $sort = 'DESC');
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}