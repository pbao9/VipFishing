<?php

namespace App\Api\V1\Repositories\CommissionHistory;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface CommissionHistoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
    public function getBalance($user_id);
}