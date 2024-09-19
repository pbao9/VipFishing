<?php

namespace App\Admin\Repositories\Ratings;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface RatingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function existsByBookingId($bookingId);
    public function getByBookingId($bookingId);
    public function existsByUserIdAndLakeId($userId, $lakeId);
}
