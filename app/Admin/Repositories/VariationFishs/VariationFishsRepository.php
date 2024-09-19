<?php

namespace App\Admin\Repositories\VariationFishs;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use App\Models\VariationFishs;

class VariationFishsRepository extends EloquentRepository implements VariationFishsRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return VariationFishs::class;
    }

    public function getAllVariationFishs(){
        return $this->model->all();
    }

    public function getFishwithVariation(){
        return $this->model::with('fish')->get();
    }

    public function findOrFailWithRelations($id, $relations = ['fish'])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    // public function findOrFail($id){
    //     return $this->model
    //         ->where('id', $id)
    //         ->first();
    // }



}