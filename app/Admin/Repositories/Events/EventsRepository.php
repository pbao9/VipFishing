<?php

namespace App\Admin\Repositories\Events;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Events\EventsRepositoryInterface;
use App\Models\Events;

class EventsRepository extends EloquentRepository implements EventsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Events::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}