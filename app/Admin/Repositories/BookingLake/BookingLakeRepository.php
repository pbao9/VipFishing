<?php

namespace App\Admin\Repositories\BookingLake;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\BookingLake\BookingLakeRepositoryInterface;
use App\Models\BookingLake;

class BookingLakeRepository extends EloquentRepository implements BookingLakeRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return BookingLake::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}