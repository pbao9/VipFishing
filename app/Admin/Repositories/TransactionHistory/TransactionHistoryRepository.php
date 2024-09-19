<?php

namespace App\Admin\Repositories\TransactionHistory;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Models\TransactionHistory;

class TransactionHistoryRepository extends EloquentRepository implements TransactionHistoryRepositoryInterface
{
    use Setup;

    protected $select = [];

    public function getModel()
    {
        return TransactionHistory::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}