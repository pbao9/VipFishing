<?php

namespace App\Admin\Repositories\Compensations;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Compensations\CompensationsRepositoryInterface;
use App\Models\Compensations;
use App\Models\User;

class CompensationsRepository extends EloquentRepository implements CompensationsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Compensations::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}