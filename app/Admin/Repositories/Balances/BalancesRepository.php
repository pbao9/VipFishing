<?php

namespace App\Admin\Repositories\Balances;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Balances\BalancesRepositoryInterface;
use App\Models\Balances;

class BalancesRepository extends EloquentRepository implements BalancesRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Balances::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getAllBalances($column = 'id', $sort = 'DESC'){
        return $this->getQueryBuilderOrderBy($column, $sort)->get();
    }
}