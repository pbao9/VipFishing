<?php

namespace App\Api\V1\Repositories\FishingSet;
use App\Admin\Repositories\FishingSet\FishingSetRepository as AdminFishingSetRepository;
use App\Api\V1\Repositories\FishingSet\FishingSetRepositoryInterface;
use App\Models\FishingSet;

class FishingSetRepository extends AdminFishingSetRepository implements FishingSetRepositoryInterface
{
    public function getModel(){
        return FishingSet::class;
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