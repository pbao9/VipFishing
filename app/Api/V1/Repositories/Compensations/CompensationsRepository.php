<?php

namespace App\Api\V1\Repositories\Compensations;
use App\Admin\Repositories\Compensations\CompensationsRepository as AdminCompensationsRepository;
use App\Api\V1\Repositories\Compensations\CompensationsRepositoryInterface;
use App\Models\Compensations;

class CompensationsRepository extends AdminCompensationsRepository implements CompensationsRepositoryInterface
{
    public function getModel(){
        return Compensations::class;
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