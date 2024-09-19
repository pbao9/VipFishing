<?php

namespace App\Admin\Repositories\Notifications;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Models\Notifications;

class NotificationsRepository extends EloquentRepository implements NotificationsRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Notifications::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}