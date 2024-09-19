<?php

namespace App\Api\V1\Repositories\User;
use App\Admin\Repositories\EloquentRepository;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return User::class;
    }
    public function findByKey($key, $value){
        $this->instance = $this->model->where($key, $value)->first();
        return $this->instance;
    }

    public function updateObject($user, $data){
        $user->update($data);
        return $user;
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