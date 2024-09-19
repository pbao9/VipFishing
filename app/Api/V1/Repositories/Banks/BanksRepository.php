<?php

namespace App\Api\V1\Repositories\Banks;
use App\Admin\Repositories\Banks\BanksRepository as AdminBanksRepository;
use App\Api\V1\Repositories\Banks\BanksRepositoryInterface;
use App\Models\Banks;

class BanksRepository extends AdminBanksRepository implements BanksRepositoryInterface
{
    public function getModel(){
        return Banks::class;
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

    public function getAll()
    {
        $this->instance = $this->model->all();
        return $this->instance;
    }

    public function paginate($page = 1, $limit = 10)
    {
        $page = $page ? $page - 1 : 0;
        $this->instance = $this->model
        ->offset($page * $limit)
        ->limit($limit)
        ->orderBy('id', 'desc')
        ->get();
        return $this->instance;
    }
}
