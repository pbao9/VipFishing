<?php

namespace App\Api\V1\Repositories\Deposits;

use App\Admin\Repositories\Deposits\DepositsRepository as AdminDepositsRepository;
use App\Api\V1\Repositories\Deposits\DepositsRepositoryInterface;
use App\Models\Deposits;

class DepositsRepository extends AdminDepositsRepository implements DepositsRepositoryInterface
{
    public function getModel()
    {
        return Deposits::class;
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

    // public function getBalance($user_id) {}
}
