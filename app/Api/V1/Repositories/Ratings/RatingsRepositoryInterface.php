<?php

namespace App\Api\V1\Repositories\Ratings;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface RatingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function existsByUserIdAndLakeId($userId, $lakeId);
}
