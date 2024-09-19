<?php

namespace App\Admin\Repositories\Withdraws;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Models\User;
use App\Models\Withdraws;

class WithdrawsRepository extends EloquentRepository implements WithdrawsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Withdraws::class;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function countWithdrawPending()
    {
        return $this->model->WithdrawPending()->count();
    }
}
