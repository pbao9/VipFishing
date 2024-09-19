<?php

namespace App\Admin\Repositories\UserEvents;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface UserEventsRepositoryInterface extends EloquentRepositoryInterface
{
    public function existUserEvent($user_id);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
