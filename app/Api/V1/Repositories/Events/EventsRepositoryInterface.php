<?php

namespace App\Api\V1\Repositories\Events;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface EventsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}