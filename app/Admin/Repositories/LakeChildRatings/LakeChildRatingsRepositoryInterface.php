<?php

namespace App\Admin\Repositories\LakeChildRatings;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface LakeChildRatingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function getQueryBookingLakeChild($lakechild_id);
}
