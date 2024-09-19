<?php

namespace App\Admin\Repositories\Deposits;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface DepositsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getBookingID($bookingId);
    public function existByBookingID($bookingId);

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
