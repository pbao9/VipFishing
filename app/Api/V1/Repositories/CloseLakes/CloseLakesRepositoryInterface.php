<?php

namespace App\Api\V1\Repositories\CloseLakes;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface CloseLakesRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}