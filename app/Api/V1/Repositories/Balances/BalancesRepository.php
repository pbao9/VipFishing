<?php

namespace App\Api\V1\Repositories\Balances;
use App\Admin\Repositories\Balances\BalancesRepository as AdminBalancesRepository;
use App\Api\V1\Repositories\Balances\BalancesRepositoryInterface;
use App\Models\Balances;

class BalancesRepository extends AdminBalancesRepository implements BalancesRepositoryInterface
{
    public function getModel(){
        return Balances::class;
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