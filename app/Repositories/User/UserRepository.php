<?php

namespace App\Repositories\User;
use App\Admin\Repositories\EloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return User::class;
    }

    public function findBy(array $data){
        $this->getQueryBuilder();
        foreach($data as $key => $value){
            $this->instance = $this->instance->where($key, $value);
        }
        return $this->instance->firstOrFail();
    }
    public function updateObject($user, $data){
        $user->update($data);
        return $user;
    }
}