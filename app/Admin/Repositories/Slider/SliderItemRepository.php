<?php

namespace App\Admin\Repositories\Slider;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Slider\SliderItemRepositoryInterface;
use App\Models\SliderItem;

class SliderItemRepository extends EloquentRepository implements SliderItemRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return SliderItem::class;
    }
    public function findOrFailWithRelations($id, $relations = ['slider'])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
    public function getQueryBuilderByColumns($column, $value){
        $this->getQueryBuilderOrderBy('position', 'asc');
        $this->instance = $this->instance->where($column, $value);
        return $this->instance;
    }
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}