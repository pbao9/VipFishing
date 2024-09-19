<?php

namespace App\Api\V1\Repositories\Withdraws;

use App\Admin\Repositories\Withdraws\WithdrawsRepository as AdminWithdrawsRepository;
use App\Api\V1\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Models\Withdraws;

class WithdrawsRepository extends AdminWithdrawsRepository implements WithdrawsRepositoryInterface
{
    public function getModel()
    {
        return Withdraws::class;
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

    public function getAll()
    {
        return $this->model->all();
    }
}
