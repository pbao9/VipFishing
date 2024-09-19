<?php

namespace App\Admin\Repositories\Notifications;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface NotificationsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}