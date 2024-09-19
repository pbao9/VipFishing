<?php

namespace App\Admin\Repositories\Lakes;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Models\Lakes;

class LakesRepository extends EloquentRepository implements LakesRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Lakes::class;
    }

    public function getAllLake()
    {
        return $this->model->all();
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getQueryBuilderWithRelations(array $relations = ['lakechilds'])
    {
        $this->getQueryBuilderOrderBy();
        $this->instance = $this->instance->with($relations);
        return $this->instance;
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('name', 'LIKE', '%' . $key . '%')
                ->orWhere('map', 'LIKE', '%' . $key . '%')
                ->orWhere('phone', 'LIKE', '%' . $key . '%');
        });
    }
    
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name', 'address', 'phone'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }
    
    public function getTotalRateValue($lakeId)
    {
        $lake = $this->model->findOrFail($lakeId);
        return $lake->countRate()->where('status', 1)->count();
    }
}
