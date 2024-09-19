<?php

namespace App\Admin\Repositories\Banks;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Banks\BanksRepositoryInterface;
use App\Models\Banks;

class BanksRepository extends EloquentRepository implements BanksRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Banks::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'code','name'], $limit = 10){
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);
        
        foreach($meta as $key => $value){
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('name', 'LIKE', '%'.$key.'%')
            ->orWhere('code', 'LIKE', '%'.$key.'%');
        });
    }
}