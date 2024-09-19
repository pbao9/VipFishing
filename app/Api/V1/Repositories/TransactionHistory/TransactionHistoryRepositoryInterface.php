<?php

namespace App\Api\V1\Repositories\TransactionHistory;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface TransactionHistoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
    // public function getBalance($user_id);
    // public function getTransactionHistoryType($type);
    // public function storeRelation($transactionHistory, $data);
    // public function updateRelation($transactionHistory, $data);
}
