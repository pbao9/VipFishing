<?php

namespace App\Admin\Repositories\TransactionHistory;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface TransactionHistoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}