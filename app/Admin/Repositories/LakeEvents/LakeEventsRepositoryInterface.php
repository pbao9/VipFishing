<?php

namespace App\Admin\Repositories\LakeEvents;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface LakeEventsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}