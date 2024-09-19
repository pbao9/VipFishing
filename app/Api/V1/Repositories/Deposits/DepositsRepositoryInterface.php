<?php

namespace App\Api\V1\Repositories\Deposits;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface DepositsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
}