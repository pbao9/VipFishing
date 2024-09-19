<?php

namespace App\Admin\Repositories\LakeFishs;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\LakeFishs\LakeFishsRepositoryInterface;
use App\Models\LakeFishs;

class LakeFishsRepository extends EloquentRepository implements LakeFishsRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return LakeFishs::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}