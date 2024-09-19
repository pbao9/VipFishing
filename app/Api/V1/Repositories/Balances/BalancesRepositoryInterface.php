<?php

namespace App\Api\V1\Repositories\Balances;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface BalancesRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    // public function checkUserHasBalance($user_id);
}