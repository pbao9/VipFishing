<?php

namespace App\Api\V1\Repositories\CloseLakes;
use App\Admin\Repositories\CloseLakes\CloseLakesRepository as AdminCloseLakesRepository;
use App\Api\V1\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Models\CloseLakes;

class CloseLakesRepository extends AdminCloseLakesRepository implements CloseLakesRepositoryInterface
{
    public function getModel(){
        return CloseLakes::class;
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