<?php

namespace App\Admin\Repositories\LakeRatings;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface LakeRatingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
