<?php

namespace App\Api\V1\Repositories\VariationFishs;
use App\Admin\Repositories\VariationFishs\VariationFishsRepository as AdminVariationFishsRepository;
use App\Api\V1\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use App\Models\VariationFishs;

class VariationFishsRepository extends AdminVariationFishsRepository implements VariationFishsRepositoryInterface
{
    public function getModel(){
        return VariationFishs::class;
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