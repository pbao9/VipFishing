<?php

namespace App\Admin\Repositories\Fishs;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Fishs\FishsRepositoryInterface;
use App\Models\Fishs;

class FishsRepository extends EloquentRepository implements FishsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Fishs::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getAllFish()
    {
        return $this->model->all();
    }

    public function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('name', 'LIKE', '%' . $key . '%');
        });
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name', 'province_id'], $limit = 10)
    {
        $this->instance = $this->model->select($select)->with('provinces');
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

}
