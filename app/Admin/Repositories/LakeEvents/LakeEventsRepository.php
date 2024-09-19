<?php

namespace App\Admin\Repositories\LakeEvents;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\LakeEvents\LakeEventsRepositoryInterface;
use App\Models\LakeEvents;

class LakeEventsRepository extends EloquentRepository implements LakeEventsRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return LakeEvents::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}