<?php

namespace App\Api\V1\Repositories\Notifications;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface NotificationsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}