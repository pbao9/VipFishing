<?php

namespace App\Admin\Repositories\UserEvents;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\UserEvents\UserEventsRepositoryInterface;
use App\Models\UserEvents;

class UserEventsRepository extends EloquentRepository implements UserEventsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return UserEvents::class;
    }

    public function existUserEvent($user_id)
    {
        return $this->model->where("user_id", $user_id)->exists();
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
