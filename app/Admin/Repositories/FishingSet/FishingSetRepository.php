<?php

namespace App\Admin\Repositories\FishingSet;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\FishingSet\FishingSetRepositoryInterface;
use App\Models\FishingSet;

class FishingSetRepository extends EloquentRepository implements FishingSetRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return FishingSet::class;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'title'], $limit = 10){
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);
        
        foreach($meta as $key => $value){
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('title', 'LIKE', '%'.$key.'%');
        });
    }
}