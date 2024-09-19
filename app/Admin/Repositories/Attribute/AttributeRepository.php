<?php

namespace App\Admin\Repositories\Attribute;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Models\Attribute;

class AttributeRepository extends EloquentRepository implements AttributeRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Attribute::class;
    }
    public function findOrFailWithVariations($id)
    {
        $this->findOrFailWithRelations($id, ['variations']);
        return $this->instance;
    }
    public function findOrFailWithRelations($id, $relations = ['variations'])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
    public function getAllPluckById($column = 'name'){
        $this->getQueryBuilderOrderBy('position', 'asc');
        $this->instance = $this->instance->has('variations')->pluck($column, 'id');
        return $this->instance;
    }
    public function getQueryBuilderWithRelations(array $relations = ['variations']){
        $this->getQueryBuilderOrderBy('position', 'asc');
        $this->instance = $this->instance->with($relations);
        return $this->instance;
    }
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}