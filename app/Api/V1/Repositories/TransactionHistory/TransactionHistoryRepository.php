<?php

namespace App\Api\V1\Repositories\TransactionHistory;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepository as AdminTransactionHistoryRepository;
use App\Api\V1\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Models\TransactionHistory;

class TransactionHistoryRepository extends AdminTransactionHistoryRepository implements TransactionHistoryRepositoryInterface
{
    public function getModel(){
        return TransactionHistory::class;
    }
	
    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
        ->firstOrFail();
		
        if ($this->instance && $this->instance->exists()) {
			return $this->instance;
		}

		return null;
    }
    public function paginate($page = 1, $limit = 10, $user_id = null)
    {
        $page = $page ? $page - 1 : 0;
        $query = $this->model;

        if ($user_id !== null) {
            $query = $query->where('user_id', $user_id);
        }

        $this->instance = $query
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();

        return $this->instance;
    }
}