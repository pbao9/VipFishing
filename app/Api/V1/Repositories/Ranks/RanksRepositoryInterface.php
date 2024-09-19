<?php

namespace App\Api\V1\Repositories\Ranks;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface RanksRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}