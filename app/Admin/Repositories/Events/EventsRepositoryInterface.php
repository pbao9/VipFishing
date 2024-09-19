<?php

namespace App\Admin\Repositories\Events;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface EventsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}