<?php

namespace App\Api\V1\Repositories\Withdraws;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface WithdrawsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    // public function getBalance($user_id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
    public function getAll();
}
