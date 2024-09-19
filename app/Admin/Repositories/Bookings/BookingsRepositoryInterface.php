<?php

namespace App\Admin\Repositories\Bookings;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface BookingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['*'], $limit = 10);
    public function getVariationFishOfBooking($data);
    public function calculateTotalPrice($data);
    public function hasPendingOrder($userId);
    public function getBookedPositions($lakechildId, $fishingsetId, $fishingDate);
    public function getByStatus($status);
}
