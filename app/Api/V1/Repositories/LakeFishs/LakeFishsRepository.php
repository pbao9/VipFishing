<?php

namespace App\Api\V1\Repositories\LakeFishs;
use App\Admin\Repositories\LakeFishs\LakeFishsRepository as AdminLakeFishsRepository;
use App\Api\V1\Repositories\LakeFishs\LakeFishsRepositoryInterface;
use App\Models\LakeFishs;

class LakeFishsRepository extends AdminLakeFishsRepository implements LakeFishsRepositoryInterface
{
    public function getModel(){
        return LakeFishs::class;
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