<?php

namespace App\Api\V1\Repositories\BookingLake;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface BookingLakeRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
}