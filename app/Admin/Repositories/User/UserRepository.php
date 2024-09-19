<?php

namespace App\Admin\Repositories\User;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return User::class;
    }
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'fullname', 'phone', 'bank_id', 'bank_number'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('fullname', 'LIKE', '%' . $key . '%')
                ->orWhere('phone', 'LIKE', '%' . $key . '%')
                ->orWhere('email', 'LIKE', '%' . $key . '%');
        });
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getQueryBuilderWithRelations($relations = ['rank', 'bank', 'balance'])
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->with($relations)->orderBy('id', 'desc');
        return $this->instance;
    }

    public function findWithRelations($id, $relations = [])
    {
        $this->find($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
}
