<?php

namespace App\Api\V1\Repositories\UserScores;
use App\Admin\Repositories\UserScores\UserScoresRepository as AdminUserScoresRepository;
use App\Api\V1\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Models\UserScores;

class UserScoresRepository extends AdminUserScoresRepository implements UserScoresRepositoryInterface
{
    public function getModel(){
        return UserScores::class;
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