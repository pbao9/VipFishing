<?php

namespace App\Api\V1\Repositories\UserEvents;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface UserEventsRepositoryInterface extends EloquentRepositoryInterface
{
    public function existUserEvent($user_id);
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}
