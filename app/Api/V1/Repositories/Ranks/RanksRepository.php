<?php

namespace App\Api\V1\Repositories\Ranks;
use App\Admin\Repositories\Ranks\RanksRepository as AdminRanksRepository;
use App\Api\V1\Repositories\Ranks\RanksRepositoryInterface;
use App\Models\Ranks;

class RanksRepository extends AdminRanksRepository implements RanksRepositoryInterface
{
    public function getModel(){
        return Ranks::class;
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