<?php

namespace App\Admin\Repositories\CommissionHistory;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface;
use App\Models\CommissionHistory;
use App\Models\User;

class CommissionHistoryRepository extends EloquentRepository implements CommissionHistoryRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return CommissionHistory::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}