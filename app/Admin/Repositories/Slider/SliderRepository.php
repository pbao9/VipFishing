<?php

namespace App\Admin\Repositories\Slider;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Slider\SliderRepositoryInterface;
use App\Models\Slider;

class SliderRepository extends EloquentRepository implements SliderRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Slider::class;
    }

    public function getQueryBuilderWithRelations(array $relations = ['items']){
        $this->getQueryBuilderOrderBy();
        $this->instance = $this->instance->with($relations);
        return $this->instance;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}