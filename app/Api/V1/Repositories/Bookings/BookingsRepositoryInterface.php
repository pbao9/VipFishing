<?php

namespace App\Api\V1\Repositories\Bookings;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface BookingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
    public function getVariationFishOfBooking($data);
    public function calculateTotalPrice($data);
    public function hasPendingOrder($userId);
    public function getBookedPositions($lakechildId, $fishingsetId, $fishingDate);
}