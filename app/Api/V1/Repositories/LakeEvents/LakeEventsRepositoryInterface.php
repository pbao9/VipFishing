<?php

namespace App\Api\V1\Repositories\LakeEvents;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface LakeEventsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}