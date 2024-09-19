<?php

namespace App\Api\V1\Repositories\LakeEvents;
use App\Admin\Repositories\LakeEvents\LakeEventsRepository as AdminLakeEventsRepository;
use App\Api\V1\Repositories\LakeEvents\LakeEventsRepositoryInterface;
use App\Models\LakeEvents;

class LakeEventsRepository extends AdminLakeEventsRepository implements LakeEventsRepositoryInterface
{
    public function getModel(){
        return LakeEvents::class;
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