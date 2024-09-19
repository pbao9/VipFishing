<?php

namespace App\Admin\Repositories\Deposits;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Deposits\DepositsRepositoryInterface;
use App\Models\Deposits;
use App\Models\User;

class DepositsRepository extends EloquentRepository implements DepositsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Deposits::class;
    }

    public function getBookingID($bookingId)
    {
        return $this->model->where("booking_id", $bookingId)->get();
    }

    public function existByBookingID($bookingId)
    {
        return $this->model->where("booking_id", $bookingId)->exists();
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function countDepositPending()
    {
        return $this->model->DepositPending()->count();
    }
}
