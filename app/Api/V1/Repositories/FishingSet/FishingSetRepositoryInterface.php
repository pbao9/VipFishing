<?php

namespace App\Api\V1\Repositories\FishingSet;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface FishingSetRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}